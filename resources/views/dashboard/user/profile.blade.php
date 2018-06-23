@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="admin a">

        @include('dashboard.partials.menu', ['index' => 'profile'])

        <div class="a-content">




            <div class="profile-avatar">
                <img src="{{ $user->get_gravatar(150) }}" class="img-thumbnail img-circle"/>
            </div>

            <div>
                <input type="text" class="form-control" id="name" value="{{ old('name')? old('name') : $user->name }}"
                       name="name" placeholder="@lang('portal.name')">
            </div>
            <div>
                <td>{{ $user->user_name }}</td>
            </div>
            <div>
                <input type="email" class="form-control" id="email"
                       value="{{ old('email')? old('email') : $user->email }}" name="email"
                       placeholder="@lang('portal.email')">
            </div>

            <div>
                <select id="gender" name="gender" class="form-control ">
                    <option value="">Select Gender</option>
                    <option value="male" {{ $user->gender == 'male'?'selected':'' }}>Male</option>
                    <option value="female" {{ $user->gender == 'female'?'selected':'' }}>Fe-Male</option>
                    <option value="third_gender" {{ $user->gender == 'third_gender'?'selected':'' }}>Third Gender
                    </option>
                </select>
            </div>
            <div>
                <input type="text" class="form-control" id="mobile"
                       value="{{ old('mobile')? old('mobile') : $user->mobile }}" name="mobile"
                       placeholder="@lang('portal.mobile')">

            </div>
            <div>
                <input type="text" class="form-control" id="phone"
                       value="{{ old('phone')? old('phone') : $user->phone }}" name="phone"
                       placeholder="@lang('app.phone')">
            </div>

            <div>
                <select id="country_id" name="country_id" class="form-control ">
                    <option value="">@lang('app.select_a_country')</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ $user->country_id == $country->id ? 'selected' :'' }}>{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="text" class="form-control" id="address"
                       value="{{ old('address')? old('address') : $user->address }}" name="address"
                       placeholder="@lang('app.address')">
            </div>
            <div>
                <th>@lang('portal.country')</th>
                <td>
                    @if($user->country)
                        {{ $user->country->country_name }}
                    @endif
                </td>
            </div>
            <div>
                <input type="text" class="form-control" id="website"
                       value="{{ old('website')? old('website') : $user->website }}" name="website"
                       placeholder="@lang('app.website')">

            </div>

            <div>
                <input type="file" id="photo" name="photo" class="filestyle">
            </div>

            <hr>

            <button type="submit" class="btn btn-primary">@lang('app.edit')</button>


            @if($user->id == auth()->user()->id)
                someth
            @endif


        </div>

    </div>

@endsection
