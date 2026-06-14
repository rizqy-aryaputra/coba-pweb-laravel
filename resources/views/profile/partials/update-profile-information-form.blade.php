<section>

    <div class="profile-form-header">

        <h2>

            Profile Information

        </h2>

        <p>

            Update your account details and
            contact information.

        </p>

    </div>

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
    >

        @csrf
        @method('PATCH')

        <div class="form-group">

            <label>

                Full Name

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
            >

            @error('name')

                <small class="error">

                    {{ $message }}

                </small>

            @enderror

        </div>

        <div class="form-group">

            <label>

                Email Address

            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
            >

            @error('email')

                <small class="error">

                    {{ $message }}

                </small>

            @enderror

        </div>

        @if (
            $user instanceof
            \Illuminate\Contracts\Auth\MustVerifyEmail
            &&
            ! $user->hasVerifiedEmail()
        )

            <div class="verify-box">

                <p>

                    Your email address is not verified.

                </p>

                <button
                    form="send-verification"
                    class="verify-btn"
                >

                    Send Verification Email

                </button>

            </div>

        @endif

        <button
            type="submit"
            class="save-btn"
        >

            Save Changes

        </button>

        @if (
            session('status')
            ===
            'profile-updated'
        )

            <p class="saved-message">

                Changes saved successfully.

            </p>

        @endif

    </form>

</section>

<style>

.profile-form-header{

    margin-bottom:35px;
}

.profile-form-header h2{

    font-size:32px;

    font-weight:300;

    margin-bottom:10px;
}

.profile-form-header p{

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
}

.form-group input:focus{

    outline:none;

    border-color:black;
}

.save-btn{

    margin-top:10px;

    padding:
        16px
        34px;

    background:black;

    color:white;

    border:none;

    letter-spacing:2px;

    cursor:pointer;
}

.error{

    color:#c53030;

    display:block;

    margin-top:8px;
}

.saved-message{

    margin-top:15px;

    color:#2f855a;
}

.verify-box{

    margin-bottom:25px;

    padding:20px;

    background:#fafafa;

    border:1px solid #eee;
}

.verify-btn{

    margin-top:10px;

    border:none;

    background:none;

    text-decoration:underline;

    cursor:pointer;
}

</style>