<?php

declare(strict_types=1);

namespace ZipStream;

use Closure;
use DateTimeInterface;
use DeflateContext;
use RuntimeException;
<<<<<<< HEAD
use ZipStream\Exception\FileSizeIncorrectException;
use ZipStream\Exception\OverflowException;
use ZipStream\Exception\ResourceActionException;
use ZipStream\Exception\SimulationFileUnknownException;
=======
use ZipStream\Exception\OverflowException;
use ZipStream\Exception\ResourceActionException;
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
use ZipStream\Exception\StreamNotReadableException;
use ZipStream\Exception\StreamNotSeekableException;

/**
 * @internal
 */
class File
{
    private const CHUNKED_READ_BLOCK_SIZE = 0x1000000;

    private Version $version;

    private int $compressedSize = 0;

    private int $uncompressedSize = 0;

    private int $crc = 0;

    private int $generalPurposeBitFlag = 0;
<<<<<<< HEAD

    private readonly string $fileName;

    /**
     * @var resource|null
     */
    private $stream;

    /**
     * @param Closure $dataCallback
     * @psalm-param Closure(): resource $dataCallback
     */
    public function __construct(
        string $fileName,
        private readonly Closure $dataCallback,
        private readonly OperationMode $operationMode,
        private readonly int $startOffset,
=======

    private readonly string $fileName;

    private int $totalSize = 0;

    /**
     * @var resource
     */
    private $stream;

    /**
     * @param resource $stream
     */
    public function __construct(
        string $fileName,
        private int $startOffset,
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
        private readonly CompressionMethod $compressionMethod,
        private readonly string $comment,
        private readonly DateTimeInterface $lastModificationDateTime,
        private readonly int $deflateLevel,
        private readonly ?int $maxSize,
<<<<<<< HEAD
        private readonly ?int $exactSize,
        private readonly bool $enableZip64,
        private readonly bool $enableZeroHeader,
        private readonly Closure $send,
        private readonly Closure $recordSentBytes,
=======
        private readonly bool $enableZip64,
        private readonly bool $enableZeroHeader,
        private readonly Closure $send,
        $stream,
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
    ) {
        $this->fileName = self::filterFilename($fileName);
        $this->checkEncoding();

        if ($this->enableZeroHeader) {
            $this->generalPurposeBitFlag |= GeneralPurposeBitFlag::ZERO_HEADER;
        }

<<<<<<< HEAD
        $this->version = $this->compressionMethod === CompressionMethod::DEFLATE ? Version::DEFLATE : Version::STORE;
    }

    public function cloneSimulationExecution(): self
    {
        return new self(
            $this->fileName,
            $this->dataCallback,
            OperationMode::NORMAL,
            $this->startOffset,
            $this->compressionMethod,
            $this->comment,
            $this->lastModificationDateTime,
            $this->deflateLevel,
            $this->maxSize,
            $this->exactSize,
            $this->enableZip64,
            $this->enableZeroHeader,
            $this->send,
            $this->recordSentBytes,
        );
    }

    public function process(): string
    {
        $forecastSize = $this->forecastSize();

        if ($this->enableZeroHeader) {
            // No calculation required
        } elseif ($this->isSimulation() && $forecastSize) {
            $this->uncompressedSize = $forecastSize;
            $this->compressedSize = $forecastSize;
        } else {
            $this->readStream(send: false);
            if (rewind($this->unpackStream()) === false) {
                throw new ResourceActionException('rewind', $this->unpackStream());
            }
        }

        $this->addFileHeader();

        $detectedSize = $forecastSize ?? $this->compressedSize;

        if (
            $this->isSimulation() &&
            $detectedSize > 0
        ) {
            ($this->recordSentBytes)($detectedSize);
        } else {
            $this->readStream(send: true);
        }

        $this->addFileFooter();
        return $this->getCdrFile();
    }

    /**
     * @return resource
     */
    private function unpackStream()
    {
        if ($this->stream) {
            return $this->stream;
        }

        if ($this->operationMode === OperationMode::SIMULATE_STRICT) {
            throw new SimulationFileUnknownException();
        }

        $this->stream = ($this->dataCallback)();

        if (!$this->enableZeroHeader && !stream_get_meta_data($this->stream)['seekable']) {
            throw new StreamNotSeekableException();
        }
        if (!(
            str_contains(stream_get_meta_data($this->stream)['mode'], 'r')
            || str_contains(stream_get_meta_data($this->stream)['mode'], 'w+')
            || str_contains(stream_get_meta_data($this->stream)['mode'], 'a+')
            || str_contains(stream_get_meta_data($this->stream)['mode'], 'x+')
            || str_contains(stream_get_meta_data($this->stream)['mode'], 'c+')
        )) {
            throw new StreamNotReadableException();
        }

        return $this->stream;
    }

    private function forecastSize(): ?int
    {
        if ($this->compressionMethod !== CompressionMethod::STORE) {
            return null;
        }
        if ($this->exactSize) {
            return $this->exactSize;
        }
        $fstat = fstat($this->unpackStream());
        if (!$fstat || !array_key_exists('size', $fstat) || $fstat['size'] < 1) {
            return null;
        }

        if ($this->maxSize !== null && $this->maxSize < $fstat['size']) {
            return $this->maxSize;
        }

        return $fstat['size'];
=======
        $this->selectVersion();

        if (!$this->enableZeroHeader && !stream_get_meta_data($stream)['seekable']) {
            throw new StreamNotSeekableException();
        }
        if (!(
            str_contains(stream_get_meta_data($stream)['mode'], 'r')
            || str_contains(stream_get_meta_data($stream)['mode'], 'w+')
            || str_contains(stream_get_meta_data($stream)['mode'], 'a+')
            || str_contains(stream_get_meta_data($stream)['mode'], 'x+')
            || str_contains(stream_get_meta_data($stream)['mode'], 'c+')
        )) {
            throw new StreamNotReadableException();
        }
        $this->stream = $stream;
    }

    public function process(): string
    {
        if (!$this->enableZeroHeader) {
            $this->readStream(send: false);
            if (rewind($this->stream) === false) {
                throw new ResourceActionException('rewind', $this->stream);
            }
        }

        $this->addFileHeader();
        $this->readStream(send: true);
        $this->addFileFooter();

        return $this->getCdrFile();
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
    }

    /**
     * Create and send zip header for this file.
     */
    private function addFileHeader(): void
    {
<<<<<<< HEAD
        $forceEnableZip64 = $this->enableZeroHeader && $this->enableZip64;

        $footer = $this->buildZip64ExtraBlock($forceEnableZip64);

        $zip64Enabled = $footer !== '';

        if($zip64Enabled) {
            $this->version = Version::ZIP64;
        }

        if ($this->generalPurposeBitFlag & GeneralPurposeBitFlag::EFS) {
            // Put the tricky entry to
            // force Linux unzip to lookup EFS flag.
            $footer .= Zs\ExtendedInformationExtraField::generate();
        }
=======
        $footer = $this->buildZip64ExtraBlock($this->enableZeroHeader && $this->enableZip64);

        if ($this->generalPurposeBitFlag & GeneralPurposeBitFlag::EFS) {
            // Put the tricky entry to
            // force Linux unzip to lookup EFS flag.
            $footer .= Zs\ExtendedInformationExtraField::generate();
        }

>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7

        $data = LocalFileHeader::generate(
            versionNeededToExtract: $this->version->value,
            generalPurposeBitFlag: $this->generalPurposeBitFlag,
            compressionMethod: $this->compressionMethod,
            lastModificationDateTime: $this->lastModificationDateTime,
            crc32UncompressedData: $this->crc,
<<<<<<< HEAD
            compressedSize: $zip64Enabled
                ? 0xFFFFFFFF
                : $this->compressedSize,
            uncompressedSize: $zip64Enabled
=======
            compressedSize: ($this->enableZip64 || $this->enableZeroHeader || $this->compressedSize > 0xFFFFFFFF)
                ? 0xFFFFFFFF
                : $this->compressedSize,
            uncompressedSize: ($this->enableZip64 || $this->enableZeroHeader || $this->uncompressedSize > 0xFFFFFFFF)
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
                ? 0xFFFFFFFF
                : $this->uncompressedSize,
            fileName: $this->fileName,
            extraField: $footer,
        );


        ($this->send)($data);
<<<<<<< HEAD
=======

        $this->totalSize +=  strlen($data);
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
    }

    /**
     * Strip characters that are not legal in Windows filenames
     * to prevent compatibility issues
     */
    private static function filterFilename(
        /**
         * Unprocessed filename
         */
        string $fileName
    ): string {
        // strip leading slashes from file name
        // (fixes bug in windows archive viewer)
        $fileName = ltrim($fileName, '/');

        return str_replace(['\\', ':', '*', '?', '"', '<', '>', '|'], '_', $fileName);
    }

    private function checkEncoding(): void
    {
        // Sets Bit 11: Language encoding flag (EFS).  If this bit is set,
        // the filename and comment fields for this file
        // MUST be encoded using UTF-8. (see APPENDIX D)
        if (mb_check_encoding($this->fileName, 'UTF-8') &&
                mb_check_encoding($this->comment, 'UTF-8')) {
            $this->generalPurposeBitFlag |= GeneralPurposeBitFlag::EFS;
        }
    }

<<<<<<< HEAD
=======
    private function selectVersion(): void
    {
        if ($this->enableZip64) {
            $this->version = Version::ZIP64;
            return;
        }
        if ($this->compressionMethod === CompressionMethod::DEFLATE) {
            $this->version = Version::DEFLATE;
            return;
        }

        $this->version = Version::STORE;
    }

>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
    private function buildZip64ExtraBlock(bool $force = false): string
    {
        $outputZip64ExtraBlock = false;

        $originalSize = null;
        if ($force || $this->uncompressedSize > 0xFFFFFFFF) {
            $outputZip64ExtraBlock = true;
            $originalSize = $this->uncompressedSize;
        }

        $compressedSize = null;
        if ($force || $this->compressedSize > 0xFFFFFFFF) {
            $outputZip64ExtraBlock = true;
            $compressedSize = $this->compressedSize;
        }

        // If this file will start over 4GB limit in ZIP file,
        // CDR record will have to use Zip64 extension to describe offset
        // to keep consistency we use the same value here
        $relativeHeaderOffset = null;
        if ($this->startOffset > 0xFFFFFFFF) {
            $outputZip64ExtraBlock = true;
            $relativeHeaderOffset = $this->startOffset;
        }

        if (!$outputZip64ExtraBlock) {
            return '';
        }

<<<<<<< HEAD
        if (!$this->enableZip64) {
=======
        if ($this->version !== Version::ZIP64) {
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
            throw new OverflowException();
        }

        return Zip64\ExtendedInformationExtraField::generate(
            originalSize: $originalSize,
            compressedSize: $compressedSize,
            relativeHeaderOffset: $relativeHeaderOffset,
            diskStartNumber: null,
        );
    }

    private function addFileFooter(): void
    {
        if (($this->compressedSize > 0xFFFFFFFF || $this->uncompressedSize > 0xFFFFFFFF) && $this->version !== Version::ZIP64) {
            throw new OverflowException();
        }

        if (!$this->enableZeroHeader) {
            return;
        }

        if ($this->version === Version::ZIP64) {
            $footer = Zip64\DataDescriptor::generate(
                crc32UncompressedData: $this->crc,
                compressedSize: $this->compressedSize,
                uncompressedSize: $this->uncompressedSize,
            );
        } else {
            $footer = DataDescriptor::generate(
                crc32UncompressedData: $this->crc,
                compressedSize: $this->compressedSize,
                uncompressedSize: $this->uncompressedSize,
            );
        }

        ($this->send)($footer);
<<<<<<< HEAD
=======

        $this->totalSize += strlen($footer);
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
    }

    private function readStream(bool $send): void
    {
        $this->compressedSize = 0;
        $this->uncompressedSize = 0;
        $hash = hash_init('crc32b');

        $deflate = $this->compressionInit();

<<<<<<< HEAD
        while (
            !feof($this->unpackStream()) &&
            ($this->maxSize === null || $this->uncompressedSize < $this->maxSize) &&
            ($this->exactSize === null || $this->uncompressedSize < $this->exactSize)
        ) {
            $readLength = min(
                ($this->maxSize ?? PHP_INT_MAX) - $this->uncompressedSize,
                ($this->exactSize ?? PHP_INT_MAX) - $this->uncompressedSize,
                self::CHUNKED_READ_BLOCK_SIZE
            );

            $data = fread($this->unpackStream(), $readLength);
=======
        while (!feof($this->stream) && ($this->maxSize === null || $this->uncompressedSize < $this->maxSize)) {
            $readLength = min(($this->maxSize ?? PHP_INT_MAX) - $this->uncompressedSize, self::CHUNKED_READ_BLOCK_SIZE);

            $data = fread($this->stream, $readLength);
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7

            hash_update($hash, $data);

            $this->uncompressedSize += strlen($data);

            if ($deflate) {
                $data =  deflate_add(
                    $deflate,
                    $data,
<<<<<<< HEAD
                    feof($this->unpackStream()) ? ZLIB_FINISH : ZLIB_NO_FLUSH
=======
                    feof($this->stream) ? ZLIB_FINISH : ZLIB_NO_FLUSH
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
                );
            }

            $this->compressedSize += strlen($data);

            if ($send) {
                ($this->send)($data);
<<<<<<< HEAD
            }
        }

        if ($this->exactSize && $this->uncompressedSize !== $this->exactSize) {
            throw new FileSizeIncorrectException(expectedSize: $this->exactSize, actualSize: $this->uncompressedSize);
        }

=======
                $this->totalSize += strlen($data);
            }
        }

>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
        $this->crc = hexdec(hash_final($hash));
    }

    private function compressionInit(): ?DeflateContext
    {
        switch($this->compressionMethod) {
            case CompressionMethod::STORE:
                // Noting to do
                return null;
            case CompressionMethod::DEFLATE:
                $deflateContext = deflate_init(
                    ZLIB_ENCODING_RAW,
                    ['level' => $this->deflateLevel]
                );

                if (!$deflateContext) {
                    // @codeCoverageIgnoreStart
                    throw new RuntimeException("Can't initialize deflate context.");
                    // @codeCoverageIgnoreEnd
                }

                // False positive, resource is no longer returned from this function
                return $deflateContext;
            default:
                // @codeCoverageIgnoreStart
                throw new RuntimeException('Unsupported Compression Method ' . print_r($this->compressionMethod, true));
                // @codeCoverageIgnoreEnd
        }
    }

    private function getCdrFile(): string
    {
        $footer = $this->buildZip64ExtraBlock();

        return CentralDirectoryFileHeader::generate(
            versionMadeBy: ZipStream::ZIP_VERSION_MADE_BY,
            versionNeededToExtract:$this->version->value,
            generalPurposeBitFlag: $this->generalPurposeBitFlag,
            compressionMethod: $this->compressionMethod,
            lastModificationDateTime: $this->lastModificationDateTime,
            crc32: $this->crc,
            compressedSize: $this->compressedSize > 0xFFFFFFFF
                ? 0xFFFFFFFF
                : $this->compressedSize,
            uncompressedSize: $this->uncompressedSize > 0xFFFFFFFF
                ? 0xFFFFFFFF
                : $this->uncompressedSize,
            fileName: $this->fileName,
            extraField: $footer,
            fileComment: $this->comment,
            diskNumberStart: 0,
            internalFileAttributes: 0,
            externalFileAttributes: 32,
            relativeOffsetOfLocalHeader: $this->startOffset > 0xFFFFFFFF
                ? 0xFFFFFFFF
                : $this->startOffset,
        );
<<<<<<< HEAD
    }

    private function isSimulation(): bool
    {
        return $this->operationMode === OperationMode::SIMULATE_LAX || $this->operationMode === OperationMode::SIMULATE_STRICT;
=======
>>>>>>> 3642be10699c60bb85d13646d6ee97a2cdff15a7
    }
}
