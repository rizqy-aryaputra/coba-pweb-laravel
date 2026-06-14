<section>

    <div class="password-header">

        <h2>

            Security Settings

        </h2>

        <p>

            Update your password to keep your
            account secure.

        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.update') }}"
    >

        @csrf
        @method('PUT')

        <div class="form-group">

            <label>

                Current Password

            </label>

            <input
                type="password"
                name="current_password"
                autocomplete="current-password"
            >

            @if(
                $errors->updatePassword
                    ->get('current_password')
            )

                <small class="error">

                    {{
                        $errors
                            ->updatePassword
                            ->first(
                                'current_password'
                            )
                    }}

                </small>

            @endif

        </div>

        <div class="form-group">

            <label>

                New Password

            </label>

            <input
                type="password"
                name="password"
                autocomplete="new-password"
            >

            @if(
                $errors->updatePassword
                    ->get('password')
            )

                <small class="error">

                    {{
                        $errors
                            ->updatePassword
                            ->first(
                                'password'
                            )
                    }}

                </small>

            @endif

        </div>

        <div class="form-group">

            <label>

                Confirm Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
            >

        </div>

        <button
            type="submit"
            class="update-password-btn"
        >

            Update Password

        </button>

        @if(
            session('status')
            ===
            'password-updated'
        )

            <p class="success-message">

                Password updated successfully.

            </p>

        @endif

    </form>

</section>

<style>

.password-header{

    margin-bottom:35px;
}

.password-header h2{

    font-size:32px;

    font-weight:300;

    margin-bottom:10px;
}

.password-header p{

    color:#666;
}

.form-group{

    margin-bottom:25px;
}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:12px;

    letter-spacing:2px;

    color:#777;
}

.form-group input{

    width:100%;

    padding:16px;

    border:1px solid #ddd;

    font-size:15px;

    transition:.3s;
}

.form-group input:focus{

    outline:none;

    border-color:black;
}

.update-password-btn{

    padding:
        16px
        34px;

    background:black;

    color:white;

    border:none;

    letter-spacing:2px;

    cursor:pointer;

    transition:.3s;
}

.update-password-btn:hover{

    opacity:.9;
}

.error{

    display:block;

    margin-top:8px;

    color:#c53030;
}

.success-message{

    margin-top:15px;

    color:#2f855a;
}

</style>