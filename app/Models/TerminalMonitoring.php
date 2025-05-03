<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;


class TerminalMonitoring extends Model
{
    use HasFactory;


    protected $fillable = [
        'serial',
        'appVersion',
        'batteryLevel',
        'bluetoothAvailable',
        'chipReaderAvailable',
        'contactlessReaderAvailable',
        'deviceIp',
        'deviceState',
        'fingerPrintReaderAvailable',
        'frontCameraAvailable',
        'magstripeReaderAvailable',
        'networkState',
        'networkType',
        'packageId',
        'printerState',
        'requestLat',
        'requestLong',
        'signalStrength',
        'storageState',
    ];


    public function scopeSearchBySerial($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            $query->where('serial', 'LIKE', "%{$search}%");
        });
    }


    public function terminal()
    {
        return $this->belongsTo(Terminal::class, 'serial', 'serial');
    }




    public function isActive(): Attribute
    {
        return Attribute::get(
            fn() => $this->terminal?->status === 'ACTIVE'
        );
    }

    /**
     * Change the terminal status to the opposite value
     */
    public function changeStatus(): void
    {
        $terminal = $this->terminal;

        if ($terminal) {
            $terminal->status = $terminal->status === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
            $terminal->save();
        }
    }
}
