

<?php $__env->startSection('title', 'Contactos del Chatbot'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <?php echo $__env->make('admin.chatbot.contacts_block', ['contacts' => $contacts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/admin/chatbot/contacts.blade.php ENDPATH**/ ?>