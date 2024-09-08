<div>

    <div style="display: flex;    justify-content: space-between;align-items:center" class="px-4">

        الدور
        <button class="btn btn-primary btn-sm btn-lg">
            {{ patients_register_today(2) ? patients_register_today(2)['number'] : 0 }} </button>
    <input type="date" wire:model.live="date"
        style="background:#77ffd7;color:#2e1805;font-weight:bold;width:50%;margin:auto" class="form-control"
        id="date">



            انتظار
            <button class="btn btn-warning btn-sm btn-lg">
                {{ $waiting }} </button>
    </div>

    <div class="listOfName">


        <button style="padding: 0;background:#ffd400" class="btn btn-sm  mychose fw-bold getMadmen">
            <i class="ri-file-add-line"></i> المضامين</button> <button style="padding: 0;background:#ffd400"
            class="btn btn-sm  mychose fw-bold getVoters d-none"> <i class="ri-file-add-line"></i>
            الرئيسية</button>

        <h4 class="openDropdown">
            <div class="d-flex" style="font-size: 15px;"> <span class="getNumber"></span> <i class="ri-search-line"></i> <span class="badge bg-success">{{count($Registers)}}</span>
            </div>
        </h4>

        <div class="dropdown active" id="showVoters">
            <input type="text" wire:model.live='search' class="form-control my-2" placeholder="البحث">
            <div class="table-responsive">


                <div class="table-responsive">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">الدور</th>
                                <th class="text-center">الاسم</th>
                                <th class="text-center">العمر</th>
                                <th class="text-center">سبب الحجز</th>
                                <th class="text-center" wire:click='resetRegister()' style="cursor: pointer">الحالة</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                            @foreach ($Registers as $item)
                                @php
                                    $bg = match ($item->status) {
                                        1 => $item->patient->gender == 1 ? '#bfc7ff' : '#e993ff',
                                        2 => 'bg-success',
                                        3 => 'bg-warning',
                                        4 => 'bg-secondary',
                                        default => '',
                                    };
                                @endphp
                                <tr style="background: {{ $item->patient->gender == 1 ? '#bfc7ff' : '#e993ff' }}">
                                    <td wire:click='handleRegister({{ $item->id }})'
                                        class="{{ $bg }} text-dark text-center" style="cursor: pointer">
                                        {{ $item->number }}</td>
                                    <td class="hover-name text-end" wire:click='getINFO({{ $item->patient->id }})'>
                                        {{ $item->patient->name }}</td>
                                    <td>{{ $item->patient->getAge() }}</td>
                                    <td>{{ $item->patient->alhajz($item->patient->id,$date)->reason->name }}</td>
                                    <td>
                                        <select class="{{ $bg }}"
                                        style="background: none; border: none; width: 80%; margin: auto; text-align: center; color: #1a1a1a; font-weight: bold; border-radius:13px"
                                        wire:model="statuses.{{ $item->id }}"
                                        wire:change="get_id({{ $item->id }})" class="form-control">
                                        <option value="1" {{ ($statuses[$item->id] ?? 0) == 1 ? 'selected' : '' }}></option>
                                        <option value="2" {{ ($statuses[$item->id] ?? 0) == 2 ? 'selected' : '' }}>دخول</option>
                                        <option value="3" {{ ($statuses[$item->id] ?? 0) == 3 ? 'selected' : '' }}>انتظار</option>
                                        <option value="4" {{ ($statuses[$item->id] ?? 0) == 4 ? 'selected' : '' }}>خروج</option>
                                    </select>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        @if ($modal_info)

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modal_info->name }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tr>
                                        <td>
                                            الاسم : {{ $modal_info->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الجنس : {{ $modal_info->gender ? 'ذكر' : 'انثي' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            العمر : {{ $modal_info->getAge() }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            البطاقة : {{ $modal_info->cid }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            تاريخ الميلاد : {{ $modal_info->date_of_birth }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الطول : {{ $modal_info->height }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الوزن : {{ $modal_info->weight }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            الهاتف : {{ $modal_info->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select wire:model='show_registers' wire:change='ShowRegisterHandler()'
                                                class="form-control">
                                                <option selected  value="" >الحجوزات</option>
                                                @foreach ($modal_info->alhajzs as $item)
                                                    <option value="{{ $item->register_days }}">
                                                        {{ $item->register_days }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @if ($more_table_data)
                                        <tr>
                                            <td>السبب :{{ $modal_info->alhajz($modal_info->id,$show_registers)->reason->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>الساعة :{{ $modal_info->created_at->format('H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <td>رقم الحجز :{{ $modal_info->alhajz($modal_info->id,$show_registers)->number }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">العلاج</label>
                                                <input type="text" style="background: #fffd6a" wire:model='aleilaj' class="form-control">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">المطلوب</label>
                                                <input type="text" style="background: #fffd6a" wire:model='almatlub' class="form-control">
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>
                                                <label for="">المدفوع</label>
                                                <input type="text" style="background: #fffd6a" wire:model='almadfue' class="form-control">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">المتبقي</label>
                                                <input type="text" disabled wire:model.live='almutabaqiy'
                                                    class="form-control">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="">الملاحظات</label>
                                                <textarea wire:model="details" class="form-control" cols="30" rows="2">{{ $modal_info->alhajz($modal_info->id,$show_registers)->details }}</textarea>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td> <button class="btn btn-success"
                                                    wire:click='updateDATA({{ $modal_info->id }})'>تعديل
                                                    البيانات</button>
                                            </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            </div>

                        @endif

                    </div>
                </div>
            </div>


        </div>
            <div class="countVoters">
                <div class="col-12">


                    @if (Session::has('delete-group'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('delete-group') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <h5 class="titlelist openDropdown "> <span class="text-white"> احصائيات اليوم                </span> </h5>
                <div class="dropdown" style="width: 100%; ">
                    <table style="margin: 0;" class="table text-center table-warning table-bordered tablelist">
                        <thead>
                            <tr>
                                <th> <span class="badge text-warning text-center"
                                        style="width:100%;text-align:left;font-size:15px;font-weight:bold;">
                                    </span> </th>
                                <th class="name text-center">الحالة</th>
                                <th>العدد</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1;
                        @endphp
                        <tbody>
                            @foreach (\App\Models\Group::all() as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td wire:click.prevent='openModal({{ $item->id }})' class="open-group">
                                        {{ $item->name }}</td>
                                    <td>{{ $item->GroupPatients($date)->count() }}</td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                </div>
            </div>



        <!-- Modal -->


        <div class="modal fade" id="modalGroup" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $group ? $group->name : '' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($group)
                            <table class="table">
                                <tr>
                                    <th>الدور</th>
                                    <th>الاسم</th>
                                </tr>
                                @foreach ($group->GroupPatients($date)->get() as $item)
                                <tr>
                                    @php
                                        $numberPatient = $item->numberPatient($item->patient->id, $date);
                                    @endphp
                                    <td>{{ $numberPatient ? $numberPatient->number : 'N/A' }}</td>
                                    <td>{{ $item->patient->name }}</td>
                                </tr>
                            @endforeach
                            </table>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    </div>
                </div>
            </div>
        </div>



    </div>



</div>
