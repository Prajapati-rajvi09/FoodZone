@extends('customerpanel.customermaster')
@section('Abhiraj')

<style>
    .cp-container {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 20px;
        background: #f8f9fa;
        margin-top: 80px; /* Offset for fixed header */
    }
    
    .cp-card {
        background: #fff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        padding: 40px;
        width: 100%;
        max-width: 550px;
        position: relative;
        overflow: hidden;
    }

    .cp-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
    }

    .cp-title {
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: #2F3542;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-group-custom {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label-premium {
        display: block;
        font-weight: 600;
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 8px;
        margin-left: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: calc(50% + 14px);
        transform: translateY(-50%);
        color: #ff4757;
        font-size: 1rem;
        z-index: 3;
    }

    .form-input-premium {
        width: 100%;
        padding: 14px 20px 14px 48px;
        background: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 500;
        color: #333;
        transition: all 0.3s ease;
    }

    .form-input-premium:focus {
        outline: none;
        border-color: #ff4757;
        background: #fff;
        box-shadow: 0 5px 15px rgba(255, 71, 87, 0.1);
    }

    .form-input-premium.is-invalid {
        border-color: #dc3545;
        background-color: #fff;
        padding-right: calc(1.5em + .75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .btn-save-premium {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 8px 20px rgba(255, 71, 87, 0.3);
        transition: all 0.3s ease;
        margin-top: 15px;
        cursor: pointer;
    }

    .btn-save-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(255, 71, 87, 0.4);
    }

    .invalid-feedback {
        font-size: 0.85rem;
        font-weight: 500;
        margin-left: 5px;
        color: #dc3545;
        display: none;
    }

    .form-input-premium.is-invalid ~ .invalid-feedback {
        display: block;
    }

    @media (max-width: 768px) {
        .cp-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="cp-container">
    <div class="cp-card animate__animated animate__fadeInUp">
        <h2 class="cp-title"><i class="fa-solid fa-lock me-2 text-danger"></i> Security Settings</h2>
        
        @if(session('message'))
            <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation me-3 fs-4"></i> 
                <div>
                    <strong>Action Required:</strong><br>
                    {{ session('message') }}
                </div>
            </div>
        @endif

        <form action="{{ url('changepassword') }}" method="post" id="changepasswordform">
            @csrf
            
            <div class="form-group-custom">
                <label class="form-label-premium">Current Password</label>
                <i class="fa-solid fa-key input-icon"></i>
                <input id="oldpassword" name="oldpassword" type="password" class="form-input-premium" placeholder="Enter current password" required>
                <div class="invalid-feedback pt-1">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> Incorrect current password.
                </div>
            </div>
            
            <div class="form-group-custom">
                <label class="form-label-premium">New Password</label>
                <i class="fa-solid fa-shield-halved input-icon"></i>
                <input id="newpassword" name="newpassword" type="password" class="form-input-premium" placeholder="Minimum 8 characters" required>
                <div class="invalid-feedback pt-1">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> Password must be at least 8 characters long.
                </div>
            </div>
            
            <div class="form-group-custom">
                <label class="form-label-premium">Confirm New Password</label>
                <i class="fa-solid fa-check-double input-icon"></i>
                <input id="conpassword" name="conpassword" type="password" class="form-input-premium" placeholder="Re-enter new password" required>
                <div class="invalid-feedback pt-1">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> Passwords do not match.
                </div>
            </div>
            
            <button class="btn-save-premium" type="submit">
                Update Password <i class="fa-solid fa-arrow-right ms-2"></i>
            </button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#changepasswordform").submit(function() {
            var invalid = false;
            
            var oldpass = $("#oldpassword").val();
            var newpass = $("#newpassword").val();
            var conpass = $("#conpassword").val();

            // Reset UI states
            $(".form-input-premium").removeClass("is-invalid");

            newpass = newpass.trim();
            if (newpass.length < 8) {
                $("#newpassword").addClass("is-invalid");
                invalid = true;
            }

            if (newpass != conpass) {
                $("#conpassword").addClass("is-invalid");
                invalid = true;
            }

            // Prevent form submit if invalid
            if (invalid) {
                return false;
            } else {
                return true;
            }
        });
        
        // Remove validation error class when user starts typing again
        $('.form-input-premium').on('input', function() {
            if ($(this).hasClass('is-invalid')) {
                $(this).removeClass('is-invalid');
            }
        });
    });
</script>

@endsection 
