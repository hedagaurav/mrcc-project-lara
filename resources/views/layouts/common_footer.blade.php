<script>
    let task_item = $('.task-hours-item').first();
    let task_item_clone = task_item.clone();
    $(document).ready(function() {
        $('.task-hours-item').first().find('.delete-task').hide();
    });

    $('#add-task').click(() => {
        task_item_clone.find('input:text').val('');
        $('.task-hours-list').append(task_item_clone.clone());

    });

    $(document).on('click', '.delete-task', function() {
        let item = $('.task-hours-item');
        if (item.length > 1) {
            $(this).closest('.task-hours-item').remove();
        } else {
            // console.log(item.length);
            // console.log(item);
            // $('.task-hours-item').first().find('.delete-task').show();
        }
    });

    
</script>
