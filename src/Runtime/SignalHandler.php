<?php

declare(strict_types=1);

namespace Hi\MCP\Runtime;

/**
 * Signal handler for graceful shutdown
 *
 * Uses PHP's pcntl extension for signal handling when available
 */
final class SignalHandler
{
    /**
     * @var array<int, array<callable>> Signal callback mapping
     */
    private array $callbacks = [];

    /**
     * @var array<int, bool> Registered signals
     */
    private array $registeredSignals = [];

    /**
     * @var bool Whether pcntl extension is enabled
     */
    private bool $pcntlEnabled;

    public function __construct()
    {
        $this->pcntlEnabled = \function_exists('pcntl_signal');

        if ($this->pcntlEnabled) {
            // Enable async signal handling
            \pcntl_async_signals(true);
        }
    }

    /**
     * Register a callback for a signal
     */
    public function register(int $signal, callable $callback): void
    {
        if (! $this->pcntlEnabled) {
            return;
        }

        $this->callbacks[$signal][] = $callback;

        // Register signal to pcntl if not already registered
        if (! isset($this->registeredSignals[$signal])) {
            $this->registerSignalToPcntl($signal);
        }
    }

    /**
     * Unregister a callback for a signal
     */
    public function unregister(int $signal, ?callable $callback = null): void
    {
        if (! $this->pcntlEnabled) {
            return;
        }

        if (null === $callback) {
            $this->unregisterSignalFromPcntl($signal);

            return;
        }

        if (isset($this->callbacks[$signal])) {
            $key = \array_search($callback, $this->callbacks[$signal], true);
            if (false !== $key) {
                unset($this->callbacks[$signal][$key]);
            }

            // Unregister signal if no callbacks left
            if (empty($this->callbacks[$signal])) {
                $this->unregisterSignalFromPcntl($signal);
            }
        }
    }

    /**
     * Process pending signals
     */
    public function process(): void
    {
        if (! $this->pcntlEnabled) {
            return;
        }

        // Manually dispatch pending signals
        if (\function_exists('pcntl_signal_dispatch')) {
            \pcntl_signal_dispatch();
        }
    }

    /**
     * Check if signal handling is supported
     */
    public function isSupported(): bool
    {
        return $this->pcntlEnabled;
    }

    /**
     * Cleanup all registered signal handlers
     */
    public function cleanup(): void
    {
        if (! $this->pcntlEnabled) {
            return;
        }

        // Reset all registered signal handlers to default
        foreach ($this->registeredSignals as $signal => $registered) {
            if ($registered) {
                \pcntl_signal($signal, \SIG_DFL);
            }
        }

        // Clear callback arrays
        $this->callbacks = [];
        $this->registeredSignals = [];
    }

    /**
     * Register signal to pcntl
     */
    private function registerSignalToPcntl(int $signal): void
    {
        \pcntl_signal($signal, fn (int $signo) => $this->triggerCallbacks($signo));
        $this->registeredSignals[$signal] = true;
    }

    /**
     * Unregister signal from pcntl
     */
    private function unregisterSignalFromPcntl(int $signal): void
    {
        \pcntl_signal($signal, \SIG_DFL);
        unset($this->callbacks[$signal]);
        unset($this->registeredSignals[$signal]);
    }

    /**
     * Trigger signal callbacks
     */
    private function triggerCallbacks(int $signal): void
    {
        if (isset($this->callbacks[$signal])) {
            foreach ($this->callbacks[$signal] as $callback) {
                try {
                    $callback($signal, \time());
                } catch (\Throwable $e) {
                    \error_log('MCP signal callback error: ' . $e->getMessage());
                }
            }
        }
    }
}
