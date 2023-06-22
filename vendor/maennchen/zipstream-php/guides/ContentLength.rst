Adding Content-Length header
=============

Adding a ``Content-Length`` header for ``ZipStream`` can be achieved by
using the options ``SIMULATION_STRICT`` or ``SIMULATION_LAX`` in the
``operationMode`` parameter.

In the ``SIMULATION_STRICT`` mode, ``ZipStream`` will not allow to calculate the
size based on reading the whole file. ``SIMULATION_LAX`` will read the whole
file if neccessary.

``SIMULATION_STRICT`` is therefore useful to make sure that the size can be
calculated efficiently.

.. code-block:: php
    use ZipStream\OperationMode;
    use ZipStream\ZipStream;

<<<<<<< HEAD
    $zip = new ZipStream(
        operationMode: OperationMode::SIMULATE_STRICT, // or SIMULATE_LAX
        defaultEnableZeroHeader: false,
        sendHttpHeaders: true,
        outputStream: $stream,
    );

    // Normally add files
    $zip->addFile('sample.txt', 'Sample String Data');

    // Use addFileFromCallback and exactSize if you want to defer opening of
    // the file resource
    $zip->addFileFromCallback(
        'sample.txt',
        exactSize: 18,
        callback: function () {
            return fopen('...');
        }
    );

    // Read resulting file size
    $size = $zip->finish();
    
    // Tell it to the browser
    header('Content-Length: '. $size);
    
    // Execute the Simulation and stream the actual zip to the client
    $zip->executeSimulation();

=======
    use ZipStream\CompressionMethod;
    use ZipStream\ZipStream;

    class Zip
        {
        private $files = [];

        public function __construct(
            private readonly string $name
        ) { }

        public function addFile(
            string $name,
            string $data,
        ): void {
            $this->files[] = ['type' => 'addFile', 'name' => $name, 'data' => $data];
        }

        public function addFileFromPath(
            string $name,
            string $path,
        ): void {
            $this->files[] = ['type' => 'addFileFromPath', 'name' => $name, 'path' => $path];
        }

        public function getEstimate(): int {
            $estimate = 22;
            foreach ($this->files as $file) {
            $estimate += 76 + 2 * strlen($file['name']);
            if ($file['type'] === 'addFile') {
                $estimate += strlen($file['data']);
            }
            if ($file['type'] === 'addFileFromPath') {
                $estimate += filesize($file['path']);
            }
            }
            return $estimate;
        }

        public function finish()
        {
            header('Content-Length: ' . $this->getEstimate());
            $zip = new ZipStream(
                outputName: $this->name,
                SendHttpHeaders: true,
                enableZip64: false,
                defaultCompressionMethod: CompressionMethod::STORE,
            );

            foreach ($this->files as $file) {
                if ($file['type'] === 'addFile') {
                    $zip->addFile(
                        fileName: $file['name'],
                        data: $file['data'],
                    );
                }
                if ($file['type'] === 'addFileFromPath') {
                    $zip->addFileFromPath(
                        fileName: $file['name'],
                        path: $file['path'],
                    );
                }
            }
            $zip->finish();
        }
    }

It only works with the following constraints:

- All file content is known beforehand.
- Content Deflation is disabled

Thanks to
`partiellkorrekt <https://github.com/maennchen/ZipStream-PHP/issues/89#issuecomment-1047949274>`_
for this workaround.
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
