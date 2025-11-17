# 文件上传

Hi Framework 提供了完整的文件上传处理功能，基于 PSR-7 HTTP 消息接口，支持单文件、多文件、大文件流式处理和安全验证。文件上传系统是构建 Web 应用和 API 服务的重要组件。

> **重要设计原则**：
> 1. **PSR-7 兼容**：完全遵循 PSR-7 接口标准
> 2. **安全优先**：内置安全验证和防护机制
> 3. **类型验证**：支持文件类型、大小、扩展名等多维度验证
> 4. **错误处理**：完善的错误处理和用户友好的错误信息

## 配置说明

### 1. 配置参数说明

| 参数名 | 类型 | 默认值 | 说明 |
|--------|------|--------|------|
| **upload_max_filesize** | string | 2M | PHP 配置：最大上传文件大小 |
| **post_max_size** | string | 8M | PHP 配置：最大 POST 数据大小 |
| **max_file_uploads** | int | 20 | PHP 配置：最大同时上传文件数 |
| **file_uploads** | bool | On | PHP 配置：是否允许文件上传 |
| **upload_tmp_dir** | string | /tmp | PHP 配置：临时文件目录 |
| **max_execution_time** | int | 30 | PHP 配置：最大执行时间（秒） |
| **memory_limit** | string | 128M | PHP 配置：内存限制 |

### 2. 安全配置建议

```ini
; php.ini 配置建议
upload_max_filesize = 10M
post_max_size = 20M
max_file_uploads = 50
file_uploads = On
upload_tmp_dir = /tmp/uploads
max_execution_time = 300
memory_limit = 256M
```

## 基础使用

### 1. 基础文件上传

```php
use Hi\Attributes\Http\Post;
use Psr\Http\Message\UploadedFileInterface;

class FileController
{
    #[Post(pattern: '/upload')]
    public function upload(ServerRequestInterface $request): array
    {
        $uploadedFiles = $request->getUploadedFiles();
        
        if (empty($uploadedFiles)) {
            throw new BadRequestException('No file uploaded');
        }

        /** @var UploadedFileInterface $uploadedFile */
        $uploadedFile = $uploadedFiles[0];

        // 检查上传错误
        if ($uploadedFile->getError() !== UPLOAD_ERR_OK) {
            throw new BadRequestException('File upload failed: ' . $this->getUploadErrorMessage($uploadedFile->getError()));
        }

        // 验证文件类型
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $uploadedFile->getClientMediaType();
        
        if (!in_array($fileType, $allowedTypes)) {
            throw new BadRequestException('File type not allowed: ' . $fileType);
        }

        // 验证文件大小 (最大 5MB)
        if ($uploadedFile->getSize() > 5 * 1024 * 1024) {
            throw new BadRequestException('File too large');
        }

        // 生成安全的文件名
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $uploadPath = '/var/www/uploads/' . $filename;

        // 移动文件
        $uploadedFile->moveTo($uploadPath);

        return [
            'message' => 'File uploaded successfully',
            'file' => [
                'original_name' => $uploadedFile->getClientFilename(),
                'filename' => $filename,
                'size' => $uploadedFile->getSize(),
                'type' => $fileType,
                'path' => $uploadPath
            ]
        ];
    }

    private function getUploadErrorMessage(int $error): string
    {
        return match($error) {
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
            default => 'Unknown upload error'
        };
    }
}
```

### 2. 多文件上传

```php
class MultiFileController
{
    #[Post(pattern: '/upload-multiple')]
    public function uploadMultiple(ServerRequestInterface $request): array
    {
        $uploadedFiles = $request->getUploadedFiles();
        
        if (empty($uploadedFiles)) {
            throw new BadRequestException('No files uploaded');
        }

        $results = [];
        $files = $uploadedFiles;

        // 处理多文件数组
        if (is_array($files)) {
            foreach ($files as $index => $file) {
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $result = $this->processFile($file, $index);
                    $results[] = $result;
                } else {
                    $results[] = [
                        'index' => $index,
                        'error' => $this->getUploadErrorMessage($file->getError())
                    ];
                }
            }
        }

        return [
            'message' => 'Files processed',
            'results' => $results,
            'total' => count($results),
            'successful' => count(array_filter($results, fn($r) => !isset($r['error'])))
        ];
    }

    private function processFile(UploadedFileInterface $file, int $index): array
    {
        $extension = pathinfo($file->getClientFilename(), PATHINFO_EXTENSION);
        $filename = $index . '_' . uniqid() . '.' . $extension;
        $uploadPath = '/var/www/uploads/' . $filename;

        $file->moveTo($uploadPath);

        return [
            'index' => $index,
            'filename' => $filename,
            'original_name' => $file->getClientFilename(),
            'size' => $file->getSize(),
            'type' => $file->getClientMediaType()
        ];
    }
}
```

## 错误处理

```php
class FileUploadException extends \Exception
{
    private array $details;
    
    public function __construct(string $message, array $details = [], int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->details = $details;
    }
    
    public function getDetails(): array
    {
        return $this->details;
    }
}

class FileUploadErrorHandler
{
    public static function handleUploadError(int $errorCode, ?string $filename = null): string
    {
        $message = match($errorCode) {
            UPLOAD_ERR_INI_SIZE => 'File exceeds server upload limit',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds form upload limit',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
            default => 'Unknown upload error'
        };
        
        if ($filename) {
            $message .= " (File: {$filename})";
        }
        
        return $message;
    }
}
```