<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Fleet;

class StoreBookingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // atau sesuaikan dengan gate/permission
    }

    public function rules()
    {
        return [
            'type'          => ['required', 'string', 'exists:fleets,type'],
            'booking_date'  => ['required', 'date', 'after_or_equal:today'],
            'origin'        => ['required', 'string', 'max:255'],
            'destination'   => ['required', 'string', 'max:255'],
            'goods_detail'  => ['required', 'string', 'min:10'],
        ];
    }

    public function withValidator($validator)
    {
        // Setelah aturan di atas, tambahkan cek armada tersedia
        $validator->after(function ($v) {
            $type = $this->input('type');
            if ($type) {
                $available = Fleet::where('type', $type)
                                  ->where('is_available', true)
                                  ->exists();
                if (! $available) {
                    $v->errors()->add(
                        'type',
                        'Maaf, tidak ada armada tersedia untuk jenis kendaraan ini.'
                    );
                }
            }
        });
    }

    public function messages()
    {
        return [
            'booking_date.after_or_equal' => 'Tanggal pemesanan tidak boleh sebelum hari ini.',
            'goods_detail.min'            => 'Detail barang harus lebih lengkap (minimal :min karakter).',
        ];
    }
}
