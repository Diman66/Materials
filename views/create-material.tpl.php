
        <div class="container">
            <h1 class="my-md-5 my-4"><?= $pageData['title']; ?></h1>
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <form class="needs-validation<?php echo ($pageData['validate'] == 'novalidate') ? 'was-validated' : ''; ?> " method="post" novalidate>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelectType" name="type_material" required>
                                <?php if (array_key_exists('material', $pageData)) { ?>
                                    <option value="" disabled>Выберите тип</option>
                                
                                    <?php foreach($pageData['type_materials'] as $value) {
                                        echo "<option value=". $value['id'] . " "; 
                                        if ($value['id']==$pageData['material']['id_type']) {echo 'selected';} else {'';};
                                        echo ">" . $value['name'] . "</option>";
                                    }; 
                                } else {?> 
                                
                                    <option value="" disabled selected>Выберите тип</option>
                                    <?php 
                                    foreach($pageData['type_materials'] as $value) {
                                        echo "<option value=". $value['id'] . ">" . $value['name'] . "</option>";
                                    };
                                };?>
                            </select>
                            <label for="floatingSelectType">Тип</label>
                            <div class="invalid-feedback">
                                Пожалуйста, выберите значение
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="category" class="form-select" id="floatingSelectCategory" required>
                                <?php if (array_key_exists('material', $pageData)) { ?>
                                    <option value="" disabled>Выберите тип</option>
                                
                                    <?php 
                                    foreach($pageData['categories'] as $value) {
                                        echo "<option value=". $value['id'] . " ";
                                        if ($value['id']==$pageData['material']['id_category']) {echo 'selected';} else {'';};
                                        echo ">" . $value['name'] . "</option>";
                                    };
                                } else {?> 
                                        
                                    <option value="" disabled selected>Выберите категорию</option>
                                    <?php 
                                    foreach($pageData['categories'] as $value) {
                                        echo "<option value=". $value['id'] . ">" . $value['name'] . "</option>";
                                    };
                                };?>                                
                            </select>
                            <label for="floatingSelectCategory">Категория</label>
                            <div class="invalid-feedback">
                                Пожалуйста, выберите значение
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input value = "<?= (array_key_exists('material', $pageData)) ? $pageData['material']['name_material'] : '' ?>" name="name" type="text" class="form-control" placeholder="Напишите название" id="floatingName" required>
                            <label for="floatingName">Название</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input value = "<?= (array_key_exists('material', $pageData)) ? $pageData['material']['autor'] : '' ?>" name="autor" type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor">
                            <label for="floatingAuthor">Авторы</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                              style="height: 100px"><?= (array_key_exists('material', $pageData)) ? $pageData['material']['description'] : '' ?></textarea>
                            <label for="floatingDescription">Описание</label>
                            <div name="15" class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"><?= (array_key_exists('button', $pageData)) ? $pageData['button'] : "Добавить" ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<!-- Optional JavaScript; choose one of the two! -->
<script>(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
