<div>
    <table class="table">
        <thead>
            <tr>
                <th>م</th>
                <th>الاسم</th>
                <th>الاجراءت</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Registers as $item)
                <tr>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->patient->name }}</td>
                    
                    @php
                        $bg = match($item->status) {
                            2 => 'bg-success',
                            3 => 'bg-warning',
                            4 => 'bg-dark',
                            default => '',
                        };
                    @endphp
                    
                    <td class="{{ $bg }}">
                        <select wire:model="statuses.{{ $item->id }}" wire:change="get_id({{ $item->id }})" class="form-control">
                            <option value="1">الاجراءت</option>
                            <option value="2">دخول</option>
                            <option value="3">انتظار</option>
                            <option value="4">تم بنجاح</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
