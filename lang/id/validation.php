<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Isi :attribute harus diterima.',
    'accepted_if' => 'Isi :attribute harus diterima ketika :other adalah :value.',
    'active_url' => 'Isi :attribute bukan URL yang valid.',
    'after' => 'Isi :attribute harus berupa tanggal setelah :date.',
    'after_or_equal' => 'Isi :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha' => 'Isi :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Isi :attribute hanya boleh berisi huruf, angka, tanda hubung (dashes), dan garis bawah (underscore).',
    'alpha_num' => 'Isi :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Isi :attribute harus berupa array.',
    'before' => 'Isi :attribute harus tanggal sebelum :date.',
    'before_or_equal' => 'Isi :attribute harus tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => 'Isi :attribute harus memiliki antara :min dan :max item.',
        'file' => 'Isi :attribute harus antara :min dan :max kilobytes.',
        'numeric' => 'Isi :attribute harus antara :min dan :max.',
        'string' => 'Isi :attribute harus antara :min dan :max karakter.',
    ],
    'boolean' => 'Bidang :attribute harus benar atau salah.',
    'confirmed' => 'Isi :attribute tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'Isi :attribute bukan tanggal yang valid.',
    'date_equals' => 'Isi :attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => 'Isi :attribute tidak cocok dengan format :format.',
    'declined' => 'Isi :attribute harus ditolak.',
    'declined_if' => 'Isi :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'Isi :attribute dan :other harus berbeda.',
    'digits' => 'Isi :attribute harus :digits digit.',
    'digits_between' => 'Isi :attribute harus antara :min dan :max digit.',
    'dimensions' => 'Isi :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Bidang :attribute memiliki nilai duplikat.',
    'doesnt_start_with' => ':attribute tidak boleh dimulai dengan salah satu dari berikut ini: :values.',
    'email' => 'Isi :attribute harus berupa alamat email yang valid.',
    'ends_with' => 'Isi :attribute harus diakhiri dengan salah satu dari berikut ini: :values.',
    'enum' => 'Isi :attribute yang dipilih tidak valid.',
    'exists' => 'Isi :attribute yang dipilih tidak valid.',
    'file' => 'Isi :attribute harus berupa file.',
    'filled' => 'Bidang :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Isi :attribute harus lebih besar dari :value.',
        'file' => 'Isi :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'Isi :attribute harus lebih besar dari :value character.',
        'array' => 'Isi :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'Isi :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Isi :attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string' => 'Isi :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array' => 'Isi :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => 'Isi :attribute harus berupa gambar.',
    'in' => 'Isi :attribute yang dipilih tidak valid.',
    'in_array' => 'Bidang :attribute tidak ada di :other.',
    'integer' => 'Isi :attribute harus bilangan bulat.',
    'ip' => 'Isi :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Isi :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Isi :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Isi :attribute harus berupa JSON string yang valid.',
    'lt' => [
        'numeric' => 'Isi :attribute harus lebih kecil dari :value.',
        'file' => 'Isi :attribute harus lebih kecil dari :value kilobytes.',
        'string' => 'Isi :attribute harus lebih kecil dari :value character.',
        'array' => 'Isi :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'Isi :attribute harus lebih kecil atau sama dengan :value.',
        'file' => 'Isi :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'Isi :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'Isi :attribute tidak boleh memiliki lebih dari :value item.',
    ],
    'mac_address' => 'Isi :attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'numeric' => ':Isi attribute tidak boleh lebih besar dari :max.',
        'file' => 'Isi :attribute tidak boleh lebih besar dari :max kilobytes.',
        'string' => 'Isi :attribute tidak boleh lebih besar dari :max karakter.',
        'array' => 'Isi :attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes' => 'Isi :attribute harus berupa file dengan tipe: :values.',
    'mimetypes' => 'Isi :attribute harus berupa file dengan tipe: :values.',
    'min' => [
        'numeric' => 'Isi :attribute minimal harus :min.',
        'file' => 'Isi :attribute minimal harus :min kilobytes.',
        'string' => 'Isi :attribute minimal harus :min karakter.',
        'array' => 'Isi :attribute harus memiliki setidaknya :min item.',
    ],
    'multiple_of' => 'Isi :attribute harus kelipatan dari :value.',
    'not_in' => 'Isi :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => 'Isi :attribute harus berupa angka.',
    'password' => 'Kata sandi salah.',
    'present' => 'Bidang :attribute harus ada.',
    'prohibited' => 'Bidang :attribute dilarang.',
    'prohibited_if' => 'Bidang :attribute dilarang ketika :other adalah :value.',
    'prohibited_unless' => 'Bidang :attribute dilarang kecuali :other ada di :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Kolom :attribute wajib diisi.',
    'required_array_keys' => 'Bidang :attribute harus berisi entri untuk: :nilai.',
    'required_if' => 'Bidang :attribute diperlukan ketika :other adalah :value.',
    'required_unless' => 'Bidang :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Bidang :attribute diperlukan saat :values ada.',
    'required_with_all' => 'Bidang :attribute diperlukan saat :values ada.',
    'required_without' => 'Bidang :attribute diperlukan bila :values tidak ada.',
    'required_without_all' => 'Bidang :attribute diperlukan bila tidak ada :values yang ada.',
    'same' => 'Isi :attribute dan :other harus cocok.',
    'size' => [
        'numeric' => 'Isi :attribute harus :size.',
        'file' => 'Isi :attribute harus :size kilobytes.',
        'string' => 'Isi :attribute harus berupa :size karakter.',
        'array' => 'Isi :attribute harus berisi :size item.',
    ],
    'starts_with' => 'Isi :attribute harus dimulai dengan salah satu dari berikut ini: :values.',
    'string' => 'Isi :attribute harus berupa string.',
    'timezone' => 'Isi :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Isi :attribute sudah ada.',
    'uploaded' => 'Isi :attribute gagal diunggah.',
    'url' => 'Isi :attribute harus berupa URL yang valid.',
    'uuid' => 'Isi :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'nama',
        'title' => 'judul',
        'category_id' => 'kategori',
        'description' => 'deskripsi',
        'quantity' => 'jumlah',
        'file_path' => 'file',
        'cover_path' => 'cover',
        'user_id' => 'pengguna',
    ],

];
