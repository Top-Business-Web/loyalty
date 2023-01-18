<?php //8c9f5dab817f1b7c73fc8a7bfa50c8b7
/** @noinspection all */

namespace Illuminate\Database\Eloquent {

    /**
     * @method static $this onlyTrashed(Builder $builder)
     * @method static int restore(Builder $builder)
     * @method static $this withTrashed(Builder $builder, $withTrashed = true)
     * @method static $this withoutTrashed(Builder $builder)
     */
    class Builder {}
}

namespace Illuminate\Http {

    /**
     * @method static bool hasValidRelativeSignature()
     * @method static bool hasValidSignature($absolute = true)
     * @method static array validate(array $rules, ...$params)
     * @method static array validateWithBag(string $errorBag, array $rules, ...$params)
     */
    class Request {}
}

namespace Illuminate\Support {

    /**
     * @method static void downloadExcel(string $fileName, string $writerType = null, $withHeadings = false)
     * @method static void storeExcel(string $filePath, string $disk = null, string $writerType = null, $withHeadings = false)
     */
    class Collection {}
}

namespace Yajra\DataTables {

    /**
     * @method static $this addTransformer($transformer)
     * @method static $this setSerializer($serializer)
     * @method static $this setTransformer($transformer)
     */
    class DataTableAbstract {}
}
