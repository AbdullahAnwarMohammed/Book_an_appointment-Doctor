<div>
    <div class="container my-4">

        <table class="table table-warning table-bordered text-center">
            <tr>
                @if (generalSetting()['break'])
                    <th>العطلة الاسبوعية</th>
                @endif
                @if (generalSetting()['start_register'])
                    <th>السماح بالحجز</th>
                @endif
                <th>مواعيد بدء العمل</th>
            </tr>
            <tr>
                @if (generalSetting()['break'])
                    <td>
                        @php
                            $arrays = [
                                0 => 'الاحد',
                                1 => 'الاثنين',
                                2 => 'الثلاثاء',
                                3 => 'الاربعاء',
                                4 => 'الخميس',
                                5 => 'الجمعة',
                                6 => 'السبت',
                            ];

                        @endphp
                        @foreach (generalSetting()['break'] as $item)
                            @switch($item)
                                @case(0)
                                    <span class="badge bg-danger">{{ $arrays[0] }}</span>
                                @break

                                @case(1)
                                    <span class="badge bg-danger">{{ $arrays[1] }}</span>
                                @break

                                @case(2)
                                    <span class="badge bg-danger">{{ $arrays[2] }}</span>
                                @break

                                @case(3)
                                    <span class="badge bg-danger">{{ $arrays[3] }}</span>
                                @break

                                @case(4)
                                    <span class="badge bg-danger">{{ $arrays[4] }}</span>
                                @break

                                @case(5)
                                    <span class="badge bg-danger">{{ $arrays[5] }}</span>
                                @break

                                @case(6)
                                    <span class="badge bg-danger">{{ $arrays[6] }}</span>
                                @break
                            @endswitch
                        @endforeach
                    </td>
                @endif
                @if (generalSetting()['start_register'])
                    <td><span class="badge bg-success">{{ generalSetting()['start_register'] }}</span> || <span
                            class="badge bg-success">{{ generalSetting()['end_register'] ? generalSetting()['end_register'] : '___' }}</span>
                    </td>
                @endif
                <td><span class="badge bg-primary">{{ generalSetting()['start_work'] }}
                    {{ generalSetting()['morning_or_night'] == 'Morning' ? 'صباحاً' : 'مساءاً' }}</span></td>
            </tr>
        </table>

        <h3 class="my-2">حجز موعد</h3>

        <div class="row">
            <div class="col-12">
                @if ($error)
                    <div class="alert alert-warning fw-bold text-center">
                      هذا الرقم غير مسجل لدينا يرجي فتح ملف اولاً
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                @endif
                <input type="text" @disabled(Auth::guard('patient')->check()) wire:model.live="cid" class="form-control"
                    placeholder=" اكتب رقم البطاقة او الهاتف المُسجل">
            </div>

            <div class="col-12">
                @if ($break_day_message)
                    <div class="alert alert-danger text-center fw-bold">هذ اليوم اجازة</div>
                @endif
                @if ($not_available)
                    <div class="alert alert-danger text-center fw-bold">هذا اليوم غير متاح</div>
                @endif
            </div>


            @if ($form)


                <div class="col-12 my-4">
                    <table class="table  table-bordered " style="background: #0d2c83;color:#fff">
                        <tr class="text-center">
                            <th>{{ $Patient->name }}</th>
                            <th class="{{ $Patient->gender ? 'bg-primary' : 'bg-danger' }}">
                                {{ $Patient->gender ? 'ذكر' : 'انثي' }}</th>
                            <th>{{ $Patient->phone }}</th>
                            <th>{{ $Patient->cid }}</th>
                            @if ($Patient->date_of_birth)
                                <th>{{ $Patient->date_of_birth }}</th>
                                <th>{{ \Carbon\Carbon::parse($Patient->date_of_birth)->age }}</th>
                            @endif
                        </tr>
                    </table>
                </div>
                <form wire:submit.prevent='addHandler'>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 position-relative">
                                    <input type="date" wire:model.live='register_days' class="form-control">
                                    <label for="date_of_birth" class="placeholder"> ادخال  تاريخ الحجز </label>
                                    @error('register_days')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($type_work != 1)
                                    <div class="col-md-3">
                                        
                                        <input type="text" disabled placeholder="الساعة" wire:model="hour"
                                            class="form-control">
                                        @error('hour')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <div class="col-md-3">
                                    {{-- <input type="text" disabled placeholder="رقم الحجز" wire:model="number"
                                        class="form-control"> --}}

                                    @php
                                        $numbers = range(1, 40);
                                        $reservedNumbers = reservations_numbers($register_days); // Assuming this returns an array of reserved numbers
                                    @endphp
                                    <select class="form-control" wire:model="number">
                                        @if ($register_days)
                                            <option selected disabled>رقم الحجز</option>
                                            @foreach ($numbers as $number)
                                                @if (!in_array($number, $reservedNumbers))
                                                    <option value="{{ $number }}">
                                                        {{ $number }}
                                                    </option>
                                                @endif
                                            @endforeach
                                           
                                        @endif

                                    </select>


                                    @error('number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">

                                    <select class="form-control" wire:model="reason_id">
                                        <option value=""> سبب الحجز</option>
                                        @foreach (\App\Models\Reason::orderBy('position', 'asc')->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('reason_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col {{ $type_work != 1 ? 'my-3' : '' }} d-flex justify-content-center">
                                    <button type="submit" style="padding: 15px" class="btn btn-success">تاكيد
                                        الحجز</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            @endif

            @if ($register_already)
                @php
                    $register_days = date('Y-m-d');
                    $Patient = \App\Models\Patient::where('cid', $cid)->orWhere('phone', $cid)->first();
                    $CheckRegisterToDayOrNo = \App\Models\Alhajz::where('patient_id', $Patient->id)
                        ->latest()
                        ->first();
                @endphp
                @if ($CheckRegisterToDayOrNo)
                    <div class="alert {{ $CheckRegisterToDayOrNo->register_days == $register_days ? 'alert-success' : 'alert-danger' }}  my-4"
                        role="alert">
                        <h4 class="alert-heading my-1">تم حجز هذا الموعد لك</h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                @if ($type_work != 1)
                                    <th>الساعة</th>
                                @endif

                                <th>رقم الحجز</th>
                                <th>الاسم</th>
                                <th>الجنس</th>
                                <th>تاريخ الجحز</th>
                            </tr>
                            <tr>
                                @if ($type_work != 1)
                                    <td>{{ $CheckRegisterToDayOrNo->hour }}</td>
                                @endif
                                <td><span class="badge bg-success">{{ $CheckRegisterToDayOrNo->number }}</span></td>
                                <td>{{ $CheckRegisterToDayOrNo->patient->name }}</td>
                                <td>{{ $CheckRegisterToDayOrNo->patient->gender ? 'ذكر' : 'انثي' }}</td>
                                <td>{{ $CheckRegisterToDayOrNo->register_days }}</td>

                            </tr>
                        </table>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
