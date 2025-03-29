<?php

namespace Deviddev\BillingoApiV3Wrapper;

class BillingoApiV3NativeWrapper extends BillingoApiV3Wrapper
{

    /**
     * Download document
     *
     * @param    integer        $id
     * @param    null|string    $path
     * @param    null|string    $extension
     *
     * @return \Deviddev\BillingoApiV3Wrapper\BillingoApiV3NativeWrapper
     */
    public function downloadInvoice(int $id, ?string $path = null, ?string $extension = null): self
    {
        $filename = $id . ($extension ?? $this->extension);
        $this->createResponse('download', [$id], true);

        file_put_contents(($path ?? $this->downloadPath) . $filename, $this->response[0]);

        $this->response = [
            'path' => ($path ?? $this->downloadPath) . $filename,
            'status' => $this->withHttpInfo ? $this->response[1] : null,
        ];

        return $this;
    }

}
