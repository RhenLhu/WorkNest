<style>
    .bg-main-green { 
        background-color: #c2c9b8; 
    }
    .bg-accent-green { 
        background-color: #a3c498; 
    }
    .bg-button-green { 
        background-color: #b2c8a2; 
    }
    .bg-button-green:hover { 
        background-color: #a1b891; 
    }
    .bg:hover { 
        background-color: #2e2e28; 
    }
    .bg-cream { 
        background-color: #f4ece1; 
    }
    .text-dark-green { 
        color: #2d3b36; 
    }
    .text-btn-dark { 
        color: #3d4d33; 
    }
    .border-dark-green { 
        border-color: #3e4431; 
        }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkNest - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-main-green flex items-center justify-center min-h-screen font-sans">

    <div class="flex flex-col md:flex-row items-center justify-between w-full max-w-3xl p-8 rounded-3xl gap-8">
        
        <div class="flex flex-col items-center text-center space-y-4">
            <div class="w-36 h-36 bg-accent-green rounded-full flex items-center justify-center relative p-2 shadow-inner">
                <div class="w-24 h-24 rounded-full bg-cream flex items-center justify-center border-4 border-dark-green">
                    <svg class="w-12 h-12 text-[#80a273]" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-dark-green tracking-tight">WorkNest</h1>
        </div>

        <div class="bg-cream p-8 rounded-3xl w-full max-w-sm shadow-sm space-y-4">
            
            <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-3">
                <?php echo csrf_field(); ?>
                
                <div>
                    <input type="email" name="email" placeholder="Email" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b2c8a2]">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs px-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#b2c8a2]">
                </div>

                <button type="submit" 
                    class="w-full py-3 bg-button-green text-btn-dark font-semibold rounded-full transition duration-150">
                    Log in
                </button>
            </form>

            <a href="<?php echo e(route('auth.microsoft')); ?>" 
                class="w-full flex items-center justify-center gap-2 py-3 bg-[#3d3d35] text-white font-medium rounded-full transition duration-150">
                <svg class="w-4 h-4" viewBox="0 0 21 21">
                    <path fill="#f25022" d="M1 1h9v9H1z"/>
                    <path fill="#00a4ef" d="M1 11h9v9H1z"/>
                    <path fill="#7fba00" d="M11 1h9v9H11z"/>
                    <path fill="#ffb900" d="M11 11h9v9H11z"/>
                </svg>
                Sign in with Microsoft
            </a>

            <div class="text-center pt-1">
                <a href="<?php echo e(route('register')); ?>" class="text-xs text-[#3d3d35] hover:underline font-medium">Create new account</a>
            </div>

        </div>

    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\WorkNest\resources\views/auth/login.blade.php ENDPATH**/ ?>