<?php //6452bcf03ad66c34bdaf2a655f81b2e6
/** @noinspection all */

namespace BeyondCode\LaravelWebSockets\Statistics\Models {

    use Illuminate\Database\Eloquent\Model;
    use LaravelIdea\Helper\BeyondCode\LaravelWebSockets\Statistics\Models\_IH_WebSocketsStatisticsEntry_C;
    use LaravelIdea\Helper\BeyondCode\LaravelWebSockets\Statistics\Models\_IH_WebSocketsStatisticsEntry_QB;

    /**
     * @method static _IH_WebSocketsStatisticsEntry_QB onWriteConnection()
     * @method _IH_WebSocketsStatisticsEntry_QB newQuery()
     * @method static _IH_WebSocketsStatisticsEntry_QB on(null|string $connection = null)
     * @method static _IH_WebSocketsStatisticsEntry_QB query()
     * @method static _IH_WebSocketsStatisticsEntry_QB with(array|string $relations)
     * @method _IH_WebSocketsStatisticsEntry_QB newModelQuery()
     * @method false|int increment(string $column, float|int $amount = 1, array $extra = [])
     * @method false|int decrement(string $column, float|int $amount = 1, array $extra = [])
     * @method static _IH_WebSocketsStatisticsEntry_C|WebSocketsStatisticsEntry[] all()
     * @mixin _IH_WebSocketsStatisticsEntry_QB
     */
    class WebSocketsStatisticsEntry extends Model {}
}
