        <ul class="subjects">
          <?php
            // 2. Perform database query
            $subjects = find_all_subjects();
            // 3. Use returned data (if any)
            while($subject = mysqli_fetch_assoc($subjects)) {
              // output data from each row
          ?>
            <?php
              echo "<li" ;
              if ($subject["id"] == $selected_subject_id){
                echo " class='selected'";
              }
              
              echo ">";
            ?>
              
                <a href="manage_content.php?subject=<?php echo urldecode($subject['id']) ?>"><?php echo $subject["menu_name"] ; ?></a>
                <ul class="pages">
                  <?php  
                    $pages = find_pages_for_subject($subject["id"]);
                    while ($page = mysqli_fetch_assoc($pages)){
                  ?>
                      <?php
                        echo "<li" ;
                        if ($page["id"] == $selected_page_id){
                          echo " class='selected'";
                        }
                        
                        echo ">";
                      ?>
                        <a href="manage_content.php?page=<?php echo urldecode($page['id']) ?>"><?php echo $page["menu_name"] ?></a>
                      </li>
                    <?php  
                      }

                    ?>
                  </ul>


              </li>
          <?php
            }
          ?>
        </ul>