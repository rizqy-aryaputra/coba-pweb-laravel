@extends('layouts.customer')

@section('content')

<div class="profile-container">

    <div class="profile-header">

        <span>
            MY PROFILE
        </span>

        <h1>

            Account Settings

        </h1>

        <p>

            Manage your personal information,
            password, and account security.

        </p>

    </div>

    <div class="profile-section">

        @include(
            'profile.partials.update-profile-information-form'
        )

    </div>

    <div class="profile-section">

        @include(
            'profile.partials.update-password-form'
        )

    </div>

    <div class="profile-section danger-zone">

        @include(
            'profile.partials.delete-user-form'
        )

    </div>

</div>

<style>

.profile-container{

    width:88%;
    max-width:1000px;

    margin:80px auto;
}

.profile-header{

    margin-bottom:60px;
}

.profile-header span{

    font-size:12px;

    letter-spacing:4px;

    color:#777;
}

.profile-header h1{

    font-size:58px;

    font-weight:300;

    margin:15px 0;
}

.profile-header p{

    color:#666;

    font-size:16px;
}

.profile-section{

    background:white;

    border:1px solid #eee;

    padding:40px;

    margin-bottom:30px;

    transition:.3s;
}

.profile-section:hover{

    box-shadow:
        0 10px 30px rgba(0,0,0,.05);
}

.danger-zone{

    border-color:#f0d6d6;
}

@media(max-width:768px){

    .profile-header h1{

        font-size:42px;
    }

    .profile-section{

        padding:25px;
    }

}

</style>

@endsection