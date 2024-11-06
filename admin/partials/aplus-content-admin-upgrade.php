<?php
// Get the current user object
$current_user = wp_get_current_user();
$user_name = !empty($current_user->display_name) ? $current_user->display_name : $current_user->user_login;
?>

<div class="wrap">
    <div class="container">

        <?php include('header.php'); ?>
        
        <?php
            if(isset($_GET['payment-status']) && isset($_GET['rp_payment_id']) && $_GET['payment-status'] == "success"){     
            ?>
                <style>
                    .successContainer {
                        max-width: 600px;
                        margin: 50px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        text-align: center;
                    }
                    .details {
                        margin: 20px 0;
                        text-align: left;
                    }
                    .details p {
                        margin: 5px 0;
                        font-size: 16px;
                    }
                    .details span {
                        font-weight: bold;
                        color: #333;
                    }

                </style>

                <div class="successContainer">
                    <h1 class="text-success">Payment Successful</h1>
                    <p>Thank you for your purchase our plan! Your payment has been successfully processed.</p>
                    <div class="details">
                        <p><span>Order ID:</span> <?php  echo $_GET['oid']; ?></p>
                        <p><span>Payment ID:</span> <?php   echo $_GET['rp_payment_id']; ?></p>
                        <p><span>Payment Status:</span> <?php echo $_GET['payment-status']; ?></p>
                    </div>
                    <a href="<?= admin_url("admin.php?page=a-plus-content") ?>" class="btn btn-primary">Continue to Dashboard</a>
                </div>
            <?php
            }else if(isset($_GET['payment-status']) && $_GET['oid'] && $_GET['payment-status'] == "cancelled"){
                ?>

                <style>
                    .successContainer {
                        max-width: 600px;
                        margin: 50px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        text-align: center;
                    }
                    .details {
                        margin: 20px 0;
                        text-align: left;
                    }
                    .details p {
                        margin: 5px 0;
                        font-size: 16px;
                    }
                    .details span {
                        font-weight: bold;
                        color: #333;
                    }

                </style>

                <div class="successContainer">
                    <h1 class="text-danger">Payment Cancelled</h1>
                    <p>Oops! You cancelled the payment.</p>
                    <div class="details">
                        <p><span>Order ID:</span> <?php  echo $_GET['oid']; ?></p>
                        <p><span>Payment Status:</span> <?php echo $_GET['payment-status']; ?></p>
                    </div>
                    <a href="<?= admin_url("admin.php?page=a-plus-content") ?>" class="btn btn-primary">Continue to Dashboard</a>
                </div>
                <?php
            }else if(isset($_GET['payment-status']) && $_GET['oid'] && $_GET['payment-status'] == "failed"){
                ?>
                <style>
                    .successContainer {
                        max-width: 600px;
                        margin: 50px auto;
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        text-align: center;
                    }
                    .details {
                        margin: 20px 0;
                        text-align: left;
                    }
                    .details p {
                        margin: 5px 0;
                        font-size: 16px;
                    }
                    .details span {
                        font-weight: bold;
                        color: #333;
                    }

                </style>
                <div class="successContainer">
                    <h1 class="text-danger">Payment Failed</h1>
                    <p>Your payment has failed.</p>
                    <div class="details">
                        <p><span>Order ID:</span> <?php  echo $_GET['oid']; ?></p>
                        <p><span>Payment ID:</span> <?php   echo $_GET['paymentid']; ?></p>
                        <p><span>Payment Status:</span> <?php echo $_GET['payment-status']; ?></p>
                        <p><span>Reason:</span> <?php echo $_GET['reason']; ?></p>
                    </div>
                    <a href="<?= admin_url("admin.php?page=a-plus-content") ?>" class="btn btn-primary">Continue to Dashboard</a>
                </div>
                <?php
            }else{
                ?>
                    <!-- Google Fonts -->
                <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
                    
                    <!-- Custom CSS -->
                    <style>
                        body {
                            font-family: 'Inter', sans-serif;
                            background-color: #f8f9fa;
                            /* padding: 50px; */
                        }
                        .form-container {
                            background-color: #ffffff;
                            padding: 40px;
                            border-radius: 8px;
                            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                        }
                        .form-title {
                            font-weight: 600;
                            margin-bottom: 30px;
                            text-align: center;
                            color: #343a40;
                        }
                        .form-label {
                            font-weight: 500;
                            color: #495057;
                        }
                        .btn-custom {
                            background-color: #0d6efd;
                            color: #ffffff;
                            font-weight: 500;
                            padding: 10px 20px;
                            border: none;
                            border-radius: 5px;
                        }
                        .btn-custom:hover {
                            background-color: #0b5ed7;
                        }
                        .form-text {
                            font-size: 0.9rem;
                            color: #6c757d;
                        }
                        .plan-card {
                            border: 1px solid #dee2e6;
                            border-radius: 8px;
                            padding: 20px;
                            margin-bottom: 20px;
                            transition: all 0.3s ease;
                        }
                        .plan-card:hover {
                            border-color: #0d6efd;
                            background-color: #f1f8ff;
                        }
                        .active {
                            border-color: #0d6efd;
                            background-color: #f1f8ff;
                        }
                        .plan-card input[type="radio"] {
                            display: none;
                        }
                        /* .plan-card input[type="radio"]:checked + label {
                            border-color: #0d6efd;
                            background-color: #e7f1ff;
                            color: #0d6efd;
                        } */
                        .plan-title {
                            font-size: 1.25rem;
                            font-weight: 600;
                            margin-bottom: 10px;
                        }
                        .plan-price {
                            font-size: 1.5rem;
                            font-weight: 700;
                            color: #0d6efd;
                        }
                        .summary {
                            font-size: 1.2rem;
                            font-weight: 500;
                            color: #495057;
                            margin-bottom: 20px;
                        }
                        .summary .total-price {
                            font-size: 1.4rem;
                            font-weight: 700;
                            color: #0d6efd;
                        }

                        .disableCard {
                            /* Apply black and white filter to all content */
                            filter: grayscale(100%);
                            /* Prevent mouse interactions */
                            pointer-events: none;
                            /* Set the cursor to not-allowed to indicate disabled state */
                            cursor: not-allowed;
                            /* Optional: Make the text color gray */
                            color: #888;
                        }
                    </style>
                    <?php
                    $current_plan = get_option('aplus_plugin_plan');
                    if(!empty(get_option('aplus_plugin_plan_updated_date'))){
                        $plan_activate_date = date('d/m/Y',strtotime(get_option('aplus_plugin_plan_updated_date')));
                    }else{
                        $plan_activate_date = '';
                    }
                    $plan1 = ['Basic','Premium','Pro','Pro Plus'];
                    $plan2 = ['Premium','Pro','Pro Plus'];
                    $plan3 = ['Pro','Pro Plus'];
                    $plan4 = ['Pro Plus'];
                    ?>
                    <div class="container" id="planContainer">
                        <div class="form-container mx-auto col-md-12 col-lg-12">
                            <h2 class="form-title"><?php if($current_plan != "Pro Plus"){ echo "Choose Your Plan"; }else{ echo "You're already on the Pro Plus plan!"; } ?></h2>

                            <form id="paymentFormSubmit" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="plan-card <?php if($current_plan == "Free"){ echo "active"; } ?> <?php if(in_array($current_plan,$plan1)){ echo "disableCard"; } ?>">
                                            <input type="radio" name="plan" id="basicPlan" value="basic" <?php if($current_plan == "Free"){ echo "checked"; } ?>>
                                            <label for="basicPlan">
                                                <div class="plan-title"> 
                                                    <?php
                                                    if($current_plan == "Basic"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                                                    ?>
                                                    Basic Plan
                                                </div>
                                                <div class="plan-price">$20</div>
                                                <p class="form-text">For 2-10 Products.</p>
                                            </label>
                                        </div>
                                        <div class="card-footer mb-2">
                                            <?php
                                            if($current_plan == "Basic"){
                                                echo "<p class='text-center form-text'>Current Plan</p>";
                                                echo "<p class='text-center form-text'>Purchased on : ".$plan_activate_date."</p>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="plan-card <?php if(in_array($current_plan,$plan2)){ echo "disableCard"; } ?>">
                                            <input type="radio" name="plan" id="premiumPlan" value="premium">
                                            <label for="premiumPlan">
                                                <div class="plan-title">
                                                    <?php
                                                    if($current_plan == "Premium"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                                                    ?>
                                                    Premium Plan
                                                </div>
                                                <div class="plan-price">$40</div>
                                                <p class="form-text">For 11-50 Products.</p>
                                            </label>
                                        </div>
                                        <div class="card-footer mb-2">
                                            <?php
                                            if($current_plan == "Premium"){
                                                echo "<p class='text-center form-text'>Current Plan</p>";
                                                echo "<p class='text-center form-text'>Purchased on : ".$plan_activate_date."</p>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="plan-card <?php if(in_array($current_plan,$plan3)){ echo "disableCard"; } ?>">
                                            <input type="radio" name="plan" id="proPlan" value="pro">
                                            <label for="proPlan">
                                                <div class="plan-title">
                                                    <?php
                                                    if($current_plan == "Pro"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                                                    ?>
                                                    Pro Plan
                                                </div>
                                                <div class="plan-price">$99</div>
                                                <p class="form-text">For 51-200 Products.</p>
                                            </label>
                                        </div>
                                        <div class="card-footer mb-2">
                                            <?php
                                                if($current_plan == "Pro"){
                                                    echo "<p class='text-center form-text'>Current Plan</p>";
                                                    echo "<p class='text-center form-text'>Purchased on : ".$plan_activate_date."</p>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="plan-card <?php if(in_array($current_plan,$plan4)){ echo "disableCard"; } ?>">
                                            <input type="radio" name="plan" id="proplusPlan" value="proPlus">
                                            <label for="proplusPlan">
                                                <div class="plan-title">
                                                    <?php
                                                    if($current_plan == "Pro Plus"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                                                    ?>
                                                    Pro+ Plan
                                                </div>
                                                <div class="plan-price">$499</div>
                                                <p class="form-text">For Unlimited Products.</p>
                                            </label>
                                        </div>
                                        <div class="card-footer mb-2">
                                            <?php
                                                if($current_plan == "Pro Plus"){
                                                    echo "<p class='text-center form-text'>Current Plan</p>";
                                                    echo "<p class='text-center form-text'>Purchased on : ".$plan_activate_date."</p>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if($current_plan != "Pro Plus"){ ?>
                                <!-- Payment Information -->
                                <h3 class="form-title">Checkout Information</h3>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="userName" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="userName" placeholder="Enter User Name" required value="<?php echo esc_html($user_name); ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="userEmail" class="form-label">Admin Email</label>
                                        <input type="email" class="form-control" name="userEmail" placeholder="Enter User Email" required value="<?php echo get_bloginfo('admin_email'); ?>" readonly>
                                    </div>
                                </div>
                                
                                <!-- Summary -->
                                <div class="summary">
                                    Selected Plan: <span id="selectedPlan"><?php if($current_plan == "Free"){ echo "Basic Plan"; } ?></span> <br>
                                    Total Price: <span class="total-price"><?php if($current_plan == "Free"){ echo "$20"; } ?></span>
                                    <input type="hidden" name="public_key" value="<?php echo get_option('aplus_plugin_public_key'); ?>" required>
                                    <input type="hidden" name="payAmount" id="payAmount" value="<?php if($current_plan == "Free"){ echo "$20"; } ?>" required>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-custom btn-lg" <?php if($current_plan == "Pro Plus"){echo "disabled='true'";}?>>Proceed to Payment</button>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    
                    <div class="text-center" id="aplusloader" style="display: none;">
                        <img src="<?php echo plugins_url('../img/Spinner-3.gif', __FILE__); ?>" alt="loader" class="img-fluid" width="100px" height="100px">
                    </div>

                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
                    <!-- JavaScript to Update Plan Summary -->
                    <script>
                        const planCards = document.querySelectorAll('input[name="plan"]');
                        const selectedPlanText = document.getElementById('selectedPlan');
                        const totalPriceText = document.querySelector('.total-price');
                        const payAmount = document.getElementById('payAmount');

                        planCards.forEach((card) => {
                            card.addEventListener('change', (e) => {
                                // Remove "active" class from all plan cards
                                planCards.forEach((c) => {
                                    c.parentElement.classList.remove("active");
                                });

                                // Add "active" class to the selected card
                                var activeCard = card.parentElement;
                                if (card.checked) {
                                    activeCard.classList.add("active");
                                }

                                // Get the plan title and price
                                const planLabel = e.target.nextElementSibling;
                                const planTitle = planLabel.querySelector('.plan-title').textContent;
                                const planPrice = planLabel.querySelector('.plan-price').textContent;

                                // Update the selected plan text and total price
                                selectedPlanText.textContent = planTitle;
                                totalPriceText.textContent = planPrice;

                                // Clean the plan price to remove any non-numeric characters (e.g., $)
                                const cleanedPrice = planPrice.replace(/[^0-9.]/g, '');

                                // Set the payAmount to the numeric value of the price
                                payAmount.value = cleanedPrice;
                            });
                        });
                    </script>


                <?php
            }
        ?>
        

    </div>
</div>