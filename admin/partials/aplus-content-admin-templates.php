
<div class="card-header">
    <h1 class="card-title">Choose a Template</h1>
</div>
<div class="card-body">
    <div class="row justify-content-center g-2">
        <div class="col-md-6">
            <h5>Template 1</h5>
            <div class="screen template-option" data-id="template1">
                <img src="<?php echo esc_url(plugins_url('../img/template-1-preview.jpg', __FILE__)); ?>" alt="Template 1">
            </div>
            <a class="btn btn-info my-2" href="<?php echo esc_url(plugins_url('../img/template-1-preview.jpg', __FILE__)); ?>" target="_blank" role="button"><i class="fa-regular fa-eye"></i> Preview</a>
            <a class="btn btn-warning my-2" href="<?= admin_url("admin.php?page=create-a-plus-content&template=1") ?>"><i class="fa-regular fa-edit"></i> Customize</a>
        </div>
        <div class="col-md-6">
            <h5>Template 2</h5>
            <div class="screen  template-option" data-id="template2">
                <img src="https://i.imgur.com/aFFEZ9U.jpg" alt="Template 2">
            </div>
            <a class="btn btn-info my-2" href="https://i.imgur.com/aFFEZ9U.jpg" role="button"><i class="fa-regular fa-eye"></i> Preview</a>
            <a class="btn btn-warning my-2" href="<?= admin_url("admin.php?page=create-a-plus-content&template=2") ?>"><i class="fa-regular fa-edit"></i> Customize</a>
        </div>
        <div class="col-md-6">
            <h5>Template 3</h5>
            <div class="screen template-option" data-id="template3">
                <img src="https://i.imgur.com/aFFEZ9U.jpg" alt="Template 3">
            </div>
            <a class="btn btn-info my-2" href="https://i.imgur.com/aFFEZ9U.jpg" role="button"><i class="fa-regular fa-eye"></i> Preview</a>
            <a class="btn btn-warning my-2" href="<?= admin_url("admin.php?page=create-a-plus-content&template=3") ?>"><i class="fa-regular fa-edit"></i> Customize</a>
        </div>
        <div class="col-md-6">
            <h5>Custom Template</h5>
            <div class="custom-screen template-option" data-id="custom">
                <p>Custom Template Box</p>
            </div>
            <a class="btn btn-warning my-2" href="<?= admin_url("admin.php?page=create-a-plus-content&template=custom") ?>"><i class="fa-regular fa-edit"></i> Customize</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>

<!-- Script to save order in local storage -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('draggableContainer');

        // Initialize Sortable
        var sortable = Sortable.create(container, {
            animation: 150,
            handle: '.grabbable',
            onEnd: function(evt) {
                saveOrder();
            }
        });

        // Function to save order in local storage
        function saveOrder() {
            var items = container.children;
            var order = [];
            for (var i = 0; i < items.length; i++) {
                order.push(items[i].id);
            }
            localStorage.setItem('aPlusContentDashboardSectionOrder', JSON.stringify(order));
        }

        // Function to load order from local storage
        function loadOrder() {
            var order = JSON.parse(localStorage.getItem('aPlusContentDashboardSectionOrder'));
            if (order) {
                var fragment = document.createDocumentFragment();
                for (var i = 0; i < order.length; i++) {
                    var item = document.getElementById(order[i]);
                    fragment.appendChild(item);
                }
                container.appendChild(fragment);
            }
        }

        // Load order when the page loads
        loadOrder();
    });
</script>
    
   
