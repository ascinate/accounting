@php
    use Illuminate\Support\Facades\DB;

    $user = DB::table('users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('users.id', session('user_id'))
        ->select('users.*', 'roles.name as role_name')
        ->first();
@endphp

<x-adminheader/>
<x-sidebar/>
<div class="content-section">
            
<div class="breadcrumb">
    <h1>User Profile</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

<div id="section_Profile_list">
    <div class="card profile-widget mt-5">
        <div class="profile-widget-header">
            <img src="{{ asset('uploads/'. $user->profile_image) }}" alt="" class="rounded-circle profile-widget-picture">
        </div>
         <div class="card-body profile-widget-description">
           <form enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="username" class="ul-form__label">Full name <span class="field_required">*</span></label> 
                    <input type="text" id="username"  class="form-control" value="{{ $user->name }}"> <!---->
                </div> 
                <div class="form-group col-md-6">
                    <label for="email" class="ul-form__label">Email <span class="field_required">*</span></label>
                     <input type="text" id="email" class="form-control"  value="{{ $user->email }}"> <!---->
                </div> 
                <div class="form-group col-md-6">
                    <label for="Avatar" class="ul-form__label">Avatar</label> 
                    <input name="profile_image" type="file" id="profile_image" class="form-control"> <!---->
                </div> 
                <div class="form-group col-md-6">
                    <label for="password" class="ul-form__label">Password <span class="field_required">*</span></label> 
                    <input type="password" id="password" placeholder="min : 6 characters" class="form-control"> <!---->
                </div> 
                <div class="form-group col-md-6">
                    <label for="password_confirmation" class="ul-form__label">Repeat password<span class="field_required">*</span> </label>
                     <input type="password" id="password_confirmation" placeholder="Repeat password" class="form-control"> <!---->
                </div>
            </div> 
            <div class="row mt-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary"><!----> <i class="i-Yes me-2 font-weight-bold"></i> Submit </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<x-adminfooter/>
