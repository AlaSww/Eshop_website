<?php include("header.php"); ?>
  <section class="page-header">
    <div class="container">
      <h1 class="page-title">All Products</h1>
      <p class="page-description">Discover our latest arrivals and bestsellers</p>
    </div>
  </section>

  <div class="container">
    <div class="products-layout">
      <div class="filters">
        <div class="filter-section">
          <div class="filter-title">
            <span>Category</span>
            <span>+</span>
          </div>
          <ul class="filter-options">
            <?php
              $categories = mysqli_query($conn, "SELECT * from category");
              if ($categories && mysqli_num_rows($categories) > 0) {
                $category_param = isset($_GET["category"]) ? (int)$_GET["category"] : 0;
                while ($row = mysqli_fetch_assoc($categories)) {
                    $cat_id = (int)$row["id"];
                    $selected = ($category_param == $cat_id) ? 'checked' : '';
                    echo '<a href="products.php?category=' . htmlspecialchars($cat_id) . '"><li class="filter-option">
                            <input type="checkbox" id="cat-' . htmlspecialchars($row["name"]) . '" class="filter-checkbox" ' . $selected . '>
                            <label for="cat-' . htmlspecialchars($row["name"]) . '" class="filter-label">' . htmlspecialchars($row["name"]) . '</label>
                          </li></a>';
                }
              }
            ?>
          </ul>
        </div>

        <div class="filter-section">
          <div class="filter-title">
            <span>Price Range</span>
            <span>+</span>
          </div>
          <ul class="filter-options">
            <li class="filter-option">
              <input type="checkbox" id="price-0-50" class="filter-checkbox">
              <label for="price-0-50" class="filter-label">$0 - $50</label>
            </li>
            <li class="filter-option">
              <input type="checkbox" id="price-50-100" class="filter-checkbox">
              <label for="price-50-100" class="filter-label">$50 - $100</label>
            </li>
            <li class="filter-option">
              <input type="checkbox" id="price-100-200" class="filter-checkbox">
              <label for="price-100-200" class="filter-label">$100 - $200</label>
            </li>
            <li class="filter-option">
              <input type="checkbox" id="price-200-plus" class="filter-checkbox">
              <label for="price-200-plus" class="filter-label">$200+</label>
            </li>
          </ul>
        </div>

      </div>

      <div class="products-content">

        <div class="products-grid">


          <?php
            $page_number = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
            $products_per_page = 4;
            $offset = ($page_number - 1) * $products_per_page;

            $sql = "SELECT * from product";
            if (isset($_GET['category'])) {
                $category = (int)$_GET['category']; 
                $sql .= " WHERE category_id = $category";
            }
            $sql .= " LIMIT $offset, $products_per_page";

            $products = mysqli_query($conn, $sql);

            if ($products && mysqli_num_rows($products) > 0) {
              while ($row = mysqli_fetch_assoc($products)) {
                echo('<div class="product-card">
                            <div class="product-image">
                            <a href="product_details.php?id=' . htmlspecialchars($row["id"]) . '"><img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["name"]) . '"></a>
                                <a href="addtocart.php?product_id=' . htmlspecialchars($row["id"]) . '&quantity=1"><div class="add-to-cart">Add to Cart</div></a>
                            </div>
                            <div class="product-info">
                            <h3 class="product-name">' . htmlspecialchars($row["name"]) . '</h3>
                            <div class="product-price">' . htmlspecialchars($row["price"]) . 'TND</div>
                            </div>
                        </div>');
              }
            } else {
                echo "<p>No products found in this category.</p>"; 
            }
          ?>
        </div>

        <div class="pagination">
          <div class="page-item page-prev">
            <?php
              $url = strtok($_SERVER["REQUEST_URI"], '?');
              parse_str($_SERVER["QUERY_STRING"], $queryParams);
              unset($queryParams['page']);
              $baseUrl = $url . '?' . http_build_query($queryParams);
              if ($page_number > 1) {
                $prevPage = $page_number - 1;
                $prevUrl = $baseUrl . (count($queryParams) ? '&' : '') . 'page=' . $prevPage;
                echo '<a href="' . htmlspecialchars($prevUrl) . '" class="page-link enabled">Previous</a>';
              } else {
                echo "";
              }
            ?>
          </div>

          <?php
            $count_sql = "SELECT COUNT(*) AS total FROM product";
             if (isset($_GET['category'])) {
                $category = (int)$_GET['category'];
                $count_sql .= " WHERE category_id = $category";
             }
            $total_products_query = mysqli_query($conn, $count_sql);
            $total_products_result = mysqli_fetch_assoc($total_products_query);
            $total_products = $total_products_result['total'];

            // Calculate the total number of pages
            $number_of_pages = ceil($total_products / $products_per_page);

            // Display the page numbers
            for ($i = 1; $i <= $number_of_pages; $i++) {
              $pageUrl = $baseUrl . (count($queryParams) ? '&' : '') . 'page=' . $i;
              echo '<div class="page-item ' . ($i == $page_number ? 'active' : '') . '">';
              echo '<a href="' . htmlspecialchars($pageUrl) . '" class="page-link">' . htmlspecialchars($i) . '</a>';
              echo '</div>';
            }
          ?>

          <div class="page-item page-next">
            <?php
              if ($page_number < $number_of_pages) {
                $nextPage = $page_number + 1;
                $nextUrl = $baseUrl . (count($queryParams) ? '&' : '') . 'page=' . $nextPage;
                echo '<a href="' . htmlspecialchars($nextUrl) . '" class="page-link enabled">Next</a>';
              } else {
                echo "";
              }
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php include("footer.php"); ?>
