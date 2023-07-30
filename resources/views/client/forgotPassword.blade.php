@extends('layouts.app')
@section('title')
    Forgot Password
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col-md-6 col-lg-4 border shadow-sm p-3 rounded">
                <form action="{{route('updatePassword')}}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$email}}"disabled>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">كلمة المرور الجديدة</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'border border-danger border-2' : '' }}" id="password" name="password" value="{{old('password')}}" required>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control  {{ $errors->has('password') ? 'border border-danger border-2' : '' }}" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">حفظ كلمة المرور الجديدة</button>
                </form>
            </div>
        </div>
    </div>
@endsection
