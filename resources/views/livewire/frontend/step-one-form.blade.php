<div>
    <div class="card">
        <div class="card-body">
            {{-- action="{{ route('frontend.register.stepOne.action') }}" --}}
            <form wire:submit='save()' method="POST">
            <div class="row">
                <div class="col-12">
                    @if ($message)
                        <div class="alert alert-success">تم فتح ملف بنجاح</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="text"data-input='required' value="{{ old('name') }}" wire:model="name"
                        placeholder="الاسم" class="form-control">
                    @error('name')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" data-input='required' wire:model.live='cid'  value="{{ old('cid') }}"
                        placeholder="رقم البطاقة" class="form-control">
                    @error('cid')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                    @if (!$cid_err)
                    <div class="text-danger fw-bold"> من فضلك ادخل رقم بطاقة بشكل صحيح</div>
                    @endif
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-6">
                    <input type="text" data-input='required' wire:model="phone" value="{{ old('phone') }}"
                        placeholder="رقم الهاتف" class="form-control">
                    @error('phone')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 position-relative">
                    <input type="date" id="date_of_birth" data-input='required' wire:model="date_of_birth" class="form-control">
                    <label for="date_of_birth" class="placeholder"> ادخال تاريخ الميلاد </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select wire:model="marital_status" class="form-control">
                        <option value="">الحالة الاجتماعية</option>
                        <option value="ارمل" @selected(old('marital_status') == 'ارمل')>ارمل</option>
                        <option value="اعزب" @selected(old('marital_status') == 'اعزب')>اعزب</option>
                        <option value="متزوج" @selected(old('marital_status') == 'متزوج')>متزوج</option>
                        <option value="مطلق" @selected(old('marital_status') == 'مطلق')>مطلق</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" value="{{ old('height') }}" placeholder="الطول" wire:model="height"
                        class="form-control">
                    @error('height')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-6">
                    <input type="text" value="{{ old('weight') }}" placeholder="الوزن" wire:model="weight"
                        class="form-control">
                    @error('weight')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="text" value="{{ old('city') }}" placeholder="المحافظة" wire:model="city"
                        class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <select wire:model="gender" data-input='required' class="form-control">
                        <option value="">الجنس</option>
                        <option value="1" @selected(old('gender') && old('gender') == 1)>ذكر</option>
                        <option value="0" @selected(old('gender') && old('gender') == 0)>انثي</option>
                    </select>
                    @error('gender')
                        <div class="text-danger fw-bold">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group my-2">
                <button type="submit"  class="btn btn-primary rounded-0">فتح ملف</button>
            </div>
            </form>
        </div>
    </div>
</div>

