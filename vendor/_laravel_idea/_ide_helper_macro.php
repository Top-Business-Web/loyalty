<?php //1b5e1efbe5be26cc8cea0cf6ca10a689
/** @noinspection all */

namespace Illuminate\Database\Eloquent {

    /**
     * @method $this onlyTrashed(Builder $builder)
     * @method int restore(Builder $builder)
     * @method $this withTrashed(Builder $builder, $withTrashed = true)
     * @method $this withoutTrashed(Builder $builder)
     */
    class Builder {}
}

namespace Illuminate\Http {

    /**
     * @method bool hasValidRelativeSignature()
     * @method bool hasValidSignature($absolute = true)
     * @method array validate(array $rules, ...$params)
     * @method array validateWithBag(string $errorBag, array $rules, ...$params)
     */
    class Request {}
}

namespace Illuminate\Support {

    /**
     * @method void downloadExcel(string $fileName, string $writerType = null, $withHeadings = false)
     * @method void storeExcel(string $filePath, string $disk = null, string $writerType = null, $withHeadings = false)
     */
    class Collection {}
}

namespace Yajra\DataTables {

    /**
     * @method $this addTransformer($transformer)
     * @method $this setSerializer($serializer)
     * @method $this setTransformer($transformer)
     */
    class DataTableAbstract {}
}
