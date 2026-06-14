<section>

    <div class="danger-header">

        <span>

            DANGER ZONE

        </span>

        <h2>

            Delete Account

        </h2>

        <p>

            Permanently remove your account and
            all associated information.

        </p>

    </div>

    <button
        class="delete-account-btn"
        x-data=""
        x-on:click.prevent="
            $dispatch(
                'open-modal',
                'confirm-user-deletion'
            )
        "
    >

        Delete Account

    </button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            class="delete-modal"
        >

            @csrf
            @method('DELETE')

            <h2>

                Delete Your Account?

            </h2>

            <p>

                This action is permanent and
                cannot be undone.

                Please enter your password
                to continue.

            </p>

            <input
                type="password"
                name="password"
                placeholder="Password"
                class="delete-input"
            >

            @if(
                $errors->userDeletion
                    ->get('password')
            )

                <small class="error">

                    {{
                        $errors
                            ->userDeletion
                            ->first(
                                'password'
                            )
                    }}

                </small>

            @endif

            <div class="delete-actions">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="cancel-btn"
                >

                    Cancel

                </button>

                <button
                    type="submit"
                    class="confirm-delete-btn"
                >

                    Delete Account

                </button>

            </div>

        </form>

    </x-modal>

</section>

<style>

.danger-header span{

    font-size:12px;

    letter-spacing:4px;

    color:#b91c1c;
}

.danger-header h2{

    margin-top:12px;

    font-size:32px;

    font-weight:300;
}

.danger-header p{

    margin-top:12px;

    color:#666;

    line-height:1.8;
}

.delete-account-btn{

    margin-top:30px;

    padding:
        16px
        32px;

    border:1px solid #b91c1c;

    background:white;

    color:#b91c1c;

    cursor:pointer;

    transition:.3s;
}

.delete-account-btn:hover{

    background:#b91c1c;

    color:white;
}

.delete-modal{

    padding:40px;
}

.delete-modal h2{

    font-size:28px;

    font-weight:300;

    margin-bottom:15px;
}

.delete-modal p{

    color:#666;

    line-height:1.8;

    margin-bottom:25px;
}

.delete-input{

    width:100%;

    padding:15px;

    border:1px solid #ddd;

    margin-bottom:20px;
}

.delete-input:focus{

    outline:none;

    border-color:black;
}

.delete-actions{

    display:flex;

    justify-content:flex-end;

    gap:12px;
}

.cancel-btn{

    padding:
        12px
        24px;

    border:1px solid #ddd;

    background:white;

    cursor:pointer;
}

.confirm-delete-btn{

    padding:
        12px
        24px;

    border:none;

    background:#b91c1c;

    color:white;

    cursor:pointer;
}

.error{

    display:block;

    color:#b91c1c;

    margin-bottom:15px;
}

</style>