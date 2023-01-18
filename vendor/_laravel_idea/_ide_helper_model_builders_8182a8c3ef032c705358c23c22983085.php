<?php //67f4f01805e2b7906ee46e791f5f52b6
/** @noinspection all */

namespace LaravelIdea\Helper\BeyondCode\LaravelWebSockets\Statistics\Models {

    use BeyondCode\LaravelWebSockets\Statistics\Models\WebSocketsStatisticsEntry;
    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Database\Query\Expression;
    use Illuminate\Pagination\LengthAwarePaginator;
    use Illuminate\Pagination\Paginator;
    use LaravelIdea\Helper\_BaseBuilder;
    use LaravelIdea\Helper\_BaseCollection;

    /**
     * @method WebSocketsStatisticsEntry|null getOrPut($key, $value)
     * @method WebSocketsStatisticsEntry|$this shift(int $count = 1)
     * @method WebSocketsStatisticsEntry|null firstOrFail($key = null, $operator = null, $value = null)
     * @method WebSocketsStatisticsEntry|$this pop(int $count = 1)
     * @method WebSocketsStatisticsEntry|null pull($key, $default = null)
     * @method WebSocketsStatisticsEntry|null last(callable $callback = null, $default = null)
     * @method WebSocketsStatisticsEntry|$this random(int|null $number = null)
     * @method WebSocketsStatisticsEntry|null sole($key = null, $operator = null, $value = null)
     * @method WebSocketsStatisticsEntry|null get($key, $default = null)
     * @method WebSocketsStatisticsEntry|null first(callable $callback = null, $default = null)
     * @method WebSocketsStatisticsEntry|null firstWhere(string $key, $operator = null, $value = null)
     * @method WebSocketsStatisticsEntry|null find($key, $default = null)
     * @method WebSocketsStatisticsEntry[] all()
     */
    class _IH_WebSocketsStatisticsEntry_C extends _BaseCollection {
        /**
         * @param int $size
         * @return WebSocketsStatisticsEntry[][]
         */
        public function chunk($size)
        {
            return [];
        }
    }

    /**
     * @method WebSocketsStatisticsEntry baseSole(array|string $columns = ['*'])
     * @method WebSocketsStatisticsEntry create(array $attributes = [])
     * @method _IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] cursor()
     * @method WebSocketsStatisticsEntry|null|_IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] find($id, array $columns = ['*'])
     * @method _IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] findMany(array|Arrayable $ids, array $columns = ['*'])
     * @method WebSocketsStatisticsEntry|_IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] findOrFail($id, array $columns = ['*'])
     * @method WebSocketsStatisticsEntry|_IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] findOrNew($id, array $columns = ['*'])
     * @method WebSocketsStatisticsEntry first(array|string $columns = ['*'])
     * @method WebSocketsStatisticsEntry firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
     * @method WebSocketsStatisticsEntry firstOrCreate(array $attributes = [], array $values = [])
     * @method WebSocketsStatisticsEntry firstOrFail(array $columns = ['*'])
     * @method WebSocketsStatisticsEntry firstOrNew(array $attributes = [], array $values = [])
     * @method WebSocketsStatisticsEntry firstWhere(array|\Closure|Expression|string $column, $operator = null, $value = null, string $boolean = 'and')
     * @method WebSocketsStatisticsEntry forceCreate(array $attributes)
     * @method _IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] fromQuery(string $query, array $bindings = [])
     * @method _IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] get(array|string $columns = ['*'])
     * @method WebSocketsStatisticsEntry getModel()
     * @method WebSocketsStatisticsEntry[] getModels(array|string $columns = ['*'])
     * @method _IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] hydrate(array $items)
     * @method WebSocketsStatisticsEntry make(array $attributes = [])
     * @method WebSocketsStatisticsEntry newModelInstance(array $attributes = [])
     * @method LengthAwarePaginator|WebSocketsStatisticsEntry[]|_IH_WebSocketsStatisticsEntry_C paginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method Paginator|WebSocketsStatisticsEntry[]|_IH_WebSocketsStatisticsEntry_C simplePaginate(int|null $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
     * @method WebSocketsStatisticsEntry sole(array|string $columns = ['*'])
     * @method WebSocketsStatisticsEntry updateOrCreate(array $attributes, array $values = [])
     */
    class _IH_WebSocketsStatisticsEntry_QB extends _BaseBuilder {}
}
