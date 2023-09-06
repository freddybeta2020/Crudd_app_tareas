$(document).ready(function() {
    // configuracion global
    let edit = false;
  
    // probando Jquery
    console.log('jquery is working!');
    fetchTasks();
    $('#task-result').hide();
  
  
    // Buscamos la llave por tipo de evento
    $('#search').keyup(function() {
      if($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
          url: 'task-search.php',
          data: {search},
          type: 'POST',          
          success: function (response) {
            console.log(response);
            if(!response.error) {
              let tasks = JSON.parse(response);                       
              let template = '';
              tasks.forEach(task => {
                template   += `
                <li>${task.name}
                </li>
               ` 
              });
              
              $('#task-result').show();
              $('#container').html(template);
            }
          } 
        })
      }
    });
  
    $('#task-form').submit(e => {
      e.preventDefault();
      const postData = {
        name: $('#name').val(),
        description: $('#description').val(),
        id: $('#taskId').val()
      };
      
      const url = edit === false ? 'task-add.php' : 'task-edit.php';
      console.log(url);
      console.log(postData, url);
      
      $.post(url, postData, (response) => {
        console.log(response);
        $('#task-form').trigger('reset');
        edit = false;
        fetchTasks();
      });
    });
  
    // Fetching Tasks
    function fetchTasks() {
      $.ajax({
        url: 'task-list.php',
        type: 'GET',
        success: function(response) {        
          const tasks = JSON.parse(response);          
          let template = '';
          tasks.forEach(task => {
            template += `
                    <tr taskId="${task.id}">
                    <td>${task.id}</td>
                    <td>
                    <a href="#" class="task-item">
                      ${task.name} 
                    </a>
                    </td>
                    <td>${task.description}</td>
                    <td>
                      <button class="task-delete btn btn-danger">
                       Eliminar 
                      </button>
                    </td>
                    </tr>
                  `
          });
          $('#tasks').html(template);
        }
      });
    }
  
    // Seleccionar una sola tarea por el ID 
    $(document).on('click', '.task-item', (e) => {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      $.post('task-single.php', {id}, function(response) {        
        const task = JSON.parse(response);        
        $('#name').val(task.name);
        $('#description').val(task.description);
        $('#taskId').val(task.id);
        edit = true;
      });
      e.preventDefault();
    });
  
    // Eliminar una sola tarea
    $(document).on('click', '.task-delete', (e) => {
      if(confirm('Quiere eliminar esta tarea ? ')) {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('taskId');
        $.post('task-delet.php', {id}, (response) => {
          console.log(response);
          fetchTasks();
        });
      }
    });
  });