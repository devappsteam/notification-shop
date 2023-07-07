<div class="wrap">
    <div class="dans-wrapper">
        <div class="dans-header">
            <div class="dans-logo">
                <img src="<?php echo DA_NOTIFICATION_SHOP_URL . "/admin/images/devapps.png"; ?>" alt="DevApps Consultoria e Desenvolvimento de Sistemas">
            </div>
            <div class="dans-link">
                <a href="https://devapps.com.br/#contact" target="_blank">Ajuda | Suporte | Feedback</a>
            </div>
        </div>
        <div class="dans-navbar">
            <ul>
                <li>
                    <a href="/wp-admin/admin.php?page=notifications" class="nav-tab">Customers</a>
                </li>
                <li>
                    <a href="/wp-admin/admin.php?page=notifications&tab=products" class="nav-tab nav-tab-active">Products</a>
                </li>
            </ul>
        </div>
        <div class="dans-content">
            <?php
            if (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == "true") {
            ?>
                <div class="dans-alert dans-alert--success">
                    Action performed successfully!
                </div>
            <?php
            }

            if (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == "false") {
            ?>
                <div class="dans-alert dans-alert--danger">
                    Oops! Action failed, please try again later!
                </div>
            <?php
            }
            ?>
            <div class="dans-postbox">
                <div class="dans-inside">
                    <div class="dans-panel">
                        <div class="dans-panel__header">
                            <h3>Add Products</h3>
                        </div>
                        <div class="dans-panel__content">
                            <div class="dans-row">
                                <div class="dans-input-text dans-full-width">
                                    <label for="__product"><strong>Enter the product name</strong></label>
                                    <input type="text" id="__product" class="dans-regular-text" name="product" placeholder="Ex. Product example" required>
                                    <label for="__image" style="margin-top: 1rem;"><strong>Enter the product url image</strong></label>
                                    <input type="text" id="__image" class="dans-regular-text" name="image" placeholder="Ex. https://image.com.br/image.png" required>
                                    <button id="__dans_submit_product" type="submit" class="dans-button dans-button-submit">
                                        Save Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dans-panel">
                        <div class="dans-panel__header">
                            <h3>Products</h3>
                        </div>
                        <div class="dans-panel__content dans--padding-0">
                            <div class="dans-list">
                            <?php
                                if (isset($products) && !empty($products)) {
                                    foreach ($products as $product) {
                                ?>
                                        <div class="dans-list__item">
                                            <div class="product-info">
                                                <img src="<?php echo $product['image']; ?>" alt="Product" loading="lazy">
                                                <p><?php echo $product['name']; ?></p>
                                            </div>
                                            <button class="dans-button dans-button--danger dans-button-remove-product" data-id="<?php echo $product['id']; ?>">Delete</button>
                                        </div>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <p style="text-align: center;">No results found</p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="dans-sidebar">
                    <img src="https://recarregueaqui.pro/wp-content/plugins/devapps-whatsapp-notification/admin/images/mdb-birds.svg">
                    <div class="dans-log">
                        <h3>Change Logs</h3>
                        <p id="status">Release - 1.0.0</p>
                        <ul>
                            <li>- Plugin Creation</li>
                            <li>- Add Customers Table</li>
                            <li>- Add Products Table</li>
                            <li>- Add Toast Notification</li>
                            <li>- Add Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>