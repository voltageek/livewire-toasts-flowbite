<?php

namespace Voltageek\LivewireToastsFlowbite\Traits;

trait Toastable
{
    public function toastSuccess(string $message): void
    {
        $this->emitToastEvent($message, 'success');
    }

    public function toastDanger(string $message): void
    {
        $this->emitToastEvent($message, 'danger');
    }

    public function toastWarning(string $message): void
    {
        $this->emitToastEvent($message, 'warning');
    }

    public function toastInfo(string $message): void
    {
        $this->emitToastEvent($message, 'info');
    }

    private function emitToastEvent(string $message, string $type): void
    {
        $this->dispatchBrowserEvent('voltageek:toast', ['type' => $type, 'message' => $message]);
    }
}