<style>
    .bg-main-green { 
        background-color: #c2c9b8; 
    }
    .bg-nav-green { 
        background-color: #b2c8a2; 
    }
    .bg-cream { 
        background-color: #f4ece1; 
    }
    .bg-cream-hover:hover { 
        background-color: #e8decb; 
    }
    .bg-table-header { 
        background-color: #e8decb; 
    }
    .bg-table-hover:hover { 
        background-color: #ebe2d3; 
    }
    .text-dark-green { 
        color: #2d3b36; 
    }
    .text-btn-dark { 
        color: #3d4d33; 
    }
    .bg-dark-btn { 
        background-color: #3d3d35; 
    }
    .bg-dark-btn:hover { 
        background-color: #2e2e28; 
    }
    .border-dark { 
        border-color: #3d3d35; 
    }
    [x-cloak] { 
        display: none !important; 
        }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkNest - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-main-green min-h-screen flex flex-col justify-between font-sans text-dark-green" x-data="{ openModal: false }">

    <div>
        <header class="bg-nav-green px-8 py-4 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-cream rounded-xl flex items-center justify-center border-2 border-dark">
                    <svg class="w-6 h-6 text-[#80a273]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-dark-green">WorkNest</span>
            </div>

            <nav class="flex items-center space-x-8 font-medium text-dark-green">
                <a href="<?php echo e(route('dashboard')); ?>" class="hover:text-black font-semibold border-b-2 border-dark pb-0.5">Home</a>
                <a href="#" class="hover:text-black transition">Calendar</a>
                <a href="#" class="hover:text-black transition">Profile</a>
                
                <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-xs bg-dark-btn text-white px-3 py-1.5 rounded-full hover:bg-black transition">
                        Logout
                    </button>
                </form>
            </nav>
        </header>

        <main class="max-w-5xl mx-auto px-6 py-8 space-y-6">

            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <button @click="openModal = true" 
                    class="w-full md:w-auto px-6 py-2.5 bg-cream bg-cream-hover text-dark-green border border-dark font-semibold rounded-full shadow-sm transition flex items-center justify-center gap-2">
                    <span class="text-lg font-bold">+</span> Add new task
                </button>

                <form action="<?php echo e(route('dashboard')); ?>" method="GET" class="w-full md:max-w-md relative">
                    <div class="relative flex items-center">
                        <svg class="w-5 h-5 absolute left-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Search tasks..."
                            class="w-full pl-12 pr-4 py-2.5 rounded-full bg-cream text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-dark">
                    </div>
                </form>
            </div>

            <div class="bg-cream rounded-3xl p-6 shadow-sm border border-[#d9d0c1]">
                <h2 class="text-2xl font-bold text-center text-dark-green mb-6">Task List</h2>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-dark">
                        <thead>
                            <tr class="bg-table-header text-left text-xs font-semibold uppercase border-b border-dark">
                                <th class="p-3 border-r border-dark w-12 text-center">Status</th>
                                <th class="p-3 border-r border-dark">Task Description</th>
                                <th class="p-3 border-r border-dark w-32">Category</th>
                                <th class="p-3 w-28 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark">
                            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="bg-table-hover transition">
                                    <td class="p-3 border-r border-dark text-center">
                                        <form action="<?php echo e(route('tasks.toggle', $task)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="w-5 h-5 rounded-full border-2 border-dark inline-flex items-center justify-center <?php echo e($task->completed ? 'bg-[#80a273]' : 'bg-white'); ?>">
                                                <?php if($task->completed): ?>
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                <?php endif; ?>
                                            </button>
                                        </form>
                                    </td>

                                    <td class="p-3 border-r border-dark">
                                        <span class="font-medium text-sm <?php echo e($task->completed ? 'line-through text-gray-500' : 'text-dark-green'); ?>">
                                            <?php echo e($task->title); ?>

                                        </span>
                                    </td>

                                    <td class="p-3 border-r border-dark">
                                        <span class="inline-block bg-dark-btn text-white text-xs px-2.5 py-1 rounded-md">
                                            <?php echo e($task->category); ?>

                                        </span>
                                    </td>

                                    <td class="p-3 text-center">
                                        <form action="<?php echo e(route('tasks.destroy', $task)); ?>" method="POST" onsubmit="return confirm('Delete this task?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="bg-dark-btn hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500 font-medium">
                                        No tasks found. Click "+ Add new task" to create one!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <footer class="bg-dark-btn py-6 text-center text-xs text-main-green mt-12">
        <p>&copy; <?php echo e(date('Y')); ?> WorkNest. All rights reserved.</p>
    </footer>

    <div x-show="openModal" 
         class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 z-50"
         x-cloak>
        <div class="bg-cream rounded-3xl p-6 w-full max-w-md shadow-xl border border-dark space-y-4"
             @click.away="openModal = false">
            
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-dark-green">New Task</h3>
                <button @click="openModal = false" class="text-gray-500 hover:text-black font-bold text-xl">&times;</button>
            </div>

            <form action="<?php echo e(route('tasks.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Task Title</label>
                    <input type="text" name="title" required placeholder="Enter task title..."
                        class="w-full px-4 py-2.5 rounded-xl bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#b2c8a2]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Category</label>
                    <input type="text" name="category" placeholder="e.g. Work, Personal"
                        class="w-full px-4 py-2.5 rounded-xl bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#b2c8a2]">
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openModal = false" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-full font-medium text-sm hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-5 py-2 bg-nav-green text-btn-dark font-semibold rounded-full text-sm hover:bg-[#a1b891]">
                        Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\WorkNest\resources\views/dashboard.blade.php ENDPATH**/ ?>