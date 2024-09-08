<div >
    <div class="row py-1">
        <div class="col-12">
            <input type="text" wire:model.live='search' class="form-control" placeholder="اسم العميل">
        </div>
    </div>
    <table class="table table-primary text-center">
        <thead>
            <tr>
                <th>م</th>
                <th>الاسم</th>
                <th>الهاتف</th>
    
                <th>رقم البطاقة</th>
                <th>عدد الحجوزات</th>
                <th>العمر</th>
                <th>الاجراءت</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @forelse ($patients as $item)
            <tr style="{{$item->gender==0 ? 'color:#ff0070' : ''}}">
                <td >{{$i++}}</td>
                <td data-id="{{$item->id}}" class="modal-customer" data-bs-toggle="modal" data-bs-target="#modalCustomer">{{$item->name}}</td>
                <td><a style="{{$item->gender==0 ? 'color:#ff0070' : ''}}" target="_blank" href="https://wa.me/{{$item->phone}}"> <i class="ri-whatsapp-line"></i></a></td>
                <td>{{$item->cid}}</td>
                <td>{{$item->alhajzs->count()}}</td>
                <td>{{$item->getAge()}}</td>
                <td>
                    <form wire:submit.prevent="delete({{$item->id}})">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('سوف تقوم بالحذف');">حذف</button>
                    </form>
                </td>
            </tr>   
            @empty
                
            <tr>
                <td colspan="6">لا يوجد حالياً</td>
            </tr>
            
            @endforelse
           
        </tbody>
    </table>
    </div>
    