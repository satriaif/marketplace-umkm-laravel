<div class="card">

   <div class="card-header">

      <input type="text" class="form-control" id="tableSearch" placeholder="Cari data...">

   </div>

   <div class="card-body">

      <div class="table-responsive border rounded" style="max-height:600px; overflow-y:auto;">

         {{ $slot }}

      </div>

   </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

   console.log('Search script loaded');

   const search = document.getElementById('tableSearch');
   const table = document.querySelector('.admin-table');

   if (!table) return;

   const rows = table.querySelectorAll('tbody tr');

   search.addEventListener('keyup', function() {

      const keyword = this.value.toLowerCase();

      rows.forEach(row => {

         row.style.display =
            row.innerText.toLowerCase().includes(keyword) ?
            '' :
            'none';

      });

   });

});
</script>