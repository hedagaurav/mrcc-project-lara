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
            // $('.task-hours-item').first().find('.delete-task').show();
        }
    });

    $('#project-table-search').on('input',() => {
        let search_value = $('#project-table-search').val();
        let rows = $('#projects_table tr');
        rows.each((index, row) => {
            
            let project_code = $(row).find('.project_code').text();
            let project_name = $(row).find('.project_name').text();
            // console.log(project_code.includes(search_value));
            if($(row).is(":hidden")){
                $(row).show();
            }
            if(project_code.includes(search_value) || project_name.includes(search_value)){
                $(row).show();
            }else{
                $(row).hide();
            }
            // console.log(project_code);
        });
        // console.log(rows);
    })

    
</script>
