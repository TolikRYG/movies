# movies
Репа по моему проекту приложения с фильмами и сериалами для DroidScript, тип приложения HTML, ниже напишу код приложения:

<html>
<head>
    <meta charset="utf-8">
    <title>Фильмы и сериалы</title>
    <script src="UI.js"></script>
    <script src="FontAwesome.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial;
        }
        .header {
            width: 100%;
            height: 7%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo {
            width: 20%;
            height: 80%;
            background-image: url("https://qna.su/logo.png");
            background-size: contain;
            background-repeat: no-repeat;
        }
        .bottom-menu {
            width: 100%;
            height: 7%;
            background-color: #fff;
            position: fixed;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
        .bottom-menu-item {
            width: 20%;
            height: 80%;
            color: #000;
            font-size: 16px;
            text-align: center;
        }
        .bottom-menu-item.active {
            color: yellow;
        }
        .main-screen {
            width: 100%;
            height: 80%;
            overflow-y: scroll;
        }
        .carousel {
            width: 100%;
            height: 25%;
            display: flex;
            align-items: center;
        }
        .carousel-title {
            width: 20%;
            height: 100%;
            color: white;
            font-size: 18px;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .carousel-content {
            width: 80%;
            height: 100%;
            overflow-x: scroll;
        }
        .movie-card {
            width: 20%;
            height: 80%;
            margin-left: 5px;
            margin-right: 5px;
            background-size: cover;
        }
        .all-screen {
            width: 100%;
            height: 80%;
        }
        .all-screen-tabs {
          width :100%;
          height :10%;
          display :flex; 
          align-items :center; 
          justify-content :space-around; 
          background-color :#333; 
          color :white; 
          font-size :18px; 
        }
        
        .all-screen-tab {
          width :50%; 
          height :80%; 
          text-align :center; 
          border-bottom :2px solid white;
         } 
        
         .all-screen-tab.active { 
           border-bottom :2px solid yellow; 
         } 
        
         .all-screen-content { 
           width :100%; 
           height :90%; 
           overflow-y :scroll; 
         } 
        
         .detail-screen { 
           width :100%; 
           height :80%; 
         } 
        
         .detail-screen-poster { 
           width :100%; 
           height :25%; 
           background-size :cover; 
         } 
        
         .detail-screen-info { 
           width :100%; 
           height :75%; 
           overflow-y :scroll; 
         } 
        
         .detail-screen-title { 
           width :100%; 
           height :10%; 
           color :white; 
           font-size :24px; 
           background-color :#333; 
           display :flex; 
           align-items :center; 
           justify-content :center; 
         } 
        
         .detail-screen-rating { 
           width :100%; 
           height :10%; 
           color :white; 
           font-size :18px; 
           background-color :#333; 
           display :flex; 
           align-items :center; 
           justify-content :center; 
         } 
        
         .detail-screen-buttons { 
           width :100%; 
           height :10%; 
           color :white; 
           font-size :24px;
           background-color :#333; 
           display :flex; 
           align-items :center; 
           justify-content :space-around; 
         } 
        
         .detail-screen-meta { 
           width :100%; 
           height :10%; 
           color :white; 
           font-size :18px; 
           background-color :#333; 
           display :flex; 
           align-items :center; 
           justify-content :space-around; 
         } 
        
         .detail-screen-tags { 
           width :100%; 
           height :10%; 
           color :white; 
           font-size :18px; 
           background-color :#333; 
           display :flex; 
           align-items :center; 
           justify-content :space-around; 
         } 
        
         .detail-screen-cast { 
           width :100%; 
           height :25%; 
           display :flex; 
           align-items :center; 
         } 
        
         .actor-card { 
           width :20%; 
           height :80%; 
           margin-left :5px; 
           margin-right :5px; 
           background-size :cover; 
         } 
        
         .detail-screen-description { 
           width :100%; 
           height :20%; 
           color :white; 
           font-size :18px;
          background-color: #333;
          padding: 10px;
        }
        .collection-screen {
          width: 100%;
          height: 80%;
        }
        .collection-screen-image {
          width: 100%;
          height: 25%;
          background-size: cover;
        }
        .collection-screen-title {
          width: 100%;
          height: 10%;
          color: white;
          font-size: 24px;
          background-color: #333;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .collection-screen-description {
          width: 100%;
          height: 10%;
          color: white;
          font-size: 18px;
          background-color: #333;
          padding: 10px;
        }
        .collection-screen-content {
          width: 100%;
          height: 55%;
          overflow-y: scroll;
        }
        .search-screen {
          width: 100%;
          height: 80%;
        }
        .search-screen-input {
          width: 100%;
          height: 10%;
          display: flex;
          align-items: center;
        }
        .search-screen-input-text {
          width: 80%;
          height: 80%;
          margin-left: 10px;
        }
        .search-screen-input-button {
          width: 20%;
          height: 80%;
          margin-right: 10px;
        }
        .search-screen-results {
          width: 100%;
          height: 90%;
          overflow-y: scroll;
        }
        .player-screen {
            width: 100%;
            height: 80%;
            display:none;
            position:absolute;
            top:-50px;
            left:-50px;
            z-index:-1
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo"></div>
    </div>
    <div class="bottom-menu">
        <div class="bottom-menu-item" id="all">Все</div>
        <div class="bottom-menu-item" id="search">Поиск</div>
        <div class="bottom-menu-item" id="favorite">Избранное</div>
        <div class="bottom-menu-item" id="profile">Профиль</div>
    </div>
    <div class="main-screen" id="main-screen">
        
    </div>
    <div class="all-screen" id="all-screen" style="display:none;">
      <div class="all-screen-tabs">
        <div class="all-screen-tab" id="movies-tab">Фильмы</div>
        <div class="all-screen-tab" id="series-tab">Сериалы</div>
      </div>
      <div class="all-screen-content" id="all-screen-content">
        
      </div>
    </div>
    <div class="detail-screen" id="detail-screen" style="display:none;">
      <div class="detail-screen-poster" id="detail-screen-poster"></div>
      <div class="detail-screen-info">
        <div class="detail-screen-title" id="detail-screen-title"></div>
        <div class="detail-screen-rating" id="detail-screen-rating"></div>
        <div class="detail-screen-buttons">
        <div class="detail-screen-button" id="watch"><i class="fa fa-play"></i> Смотреть</div>
          <div class="detail-screen-button" id="like"><i class="fa fa-thumbs-up"></i> Лайк</div>
          <div class="detail-screen-button" id="dislike"><i class="fa fa-thumbs-down"></i> Дизлайк</div>
          <div class="detail-screen-button" id="share"><i class="fa fa-share-alt"></i> Поделиться</div>
        </div>
        <div class="detail-screen-meta">
          <div class="detail-screen-meta-item" id="date">Дата: </div>
          <div class="detail-screen-meta-item" id="director">Режиссёр: </div>
        </div>
        <div class="detail-screen-tags">
          
        </div>
        <div class="detail-screen-cast">
          
        </div>
        <div class="detail-screen-description" id="detail-screen-description"></div>
      </div>
    </div>
    <div class="collection-screen" id="collection-screen" style="display:none;">
      <div class="collection-screen-image" id="collection-screen-image"></div>
      <div class="collection-screen-title" id="collection-screen-title"></div>
      <div class="collection-screen-description" id="collection-screen-description"></div>
      <div class="collection-screen-content" id="collection-screen-content">
        
      </div>
    </div>
    <div class="search-screen" id="search-screen" style="display:none;">
      <div class="search-screen-input">
        <input type="text" id="search-screen-input-text" placeholder="Введите название фильма или сериала">
        <button id="search-screen-input-button">Поиск</button>
      </div>
      <div class="search-screen-results" id="search-screen-results">
        
      </div>
    </div>
    <iframe src="" id ="player-frame" style ="width:100%;height:100%;position:absolute;top:0px;left:0px;display:none;"></iframe>
    <!-- Код droidscript для работы с интерфейсом приложения -->
    <script>
    // Глобальные переменные для хранения данных о фильмах и подборках
    var movies = [];
    var series = [];
    var collections = [];

    // Функция для инициализации приложения
    function OnStart() {
      // Загрузка данных о фильмах и подборках из базы данных
      load_movies();
      load_series();
      load_collections();

      // Добавление обработчиков событий для элементов интерфейса
      add_event_listeners();

      // Отображение главного экрана с каруселями фильмов и сериалов
      show_main_screen();
    }

    // Функция для загрузки данных о фильмах из базы данных
    function load_movies() {
      ajax("https://qna.su/movies.php?action=get_all_movies&type=movie", function(data) {
        movies = JSON.parse(data);
        console.log("Loaded " + movies.length + " movies");
      });
    }

    // Функция для загрузки данных о сериалах из базы данных
    function load_series() {
      ajax("https://qna.su/movies.php?action=get_all_movies&type=series", function(data) {
        series = JSON.parse(data);
        console.log("Loaded " + series.length + " series");
      });
    }

    // Функция для загрузки данных о подборках из базы данных
        function load_collections() {
      ajax("https://qna.su/movies.php?action=get_all_collections&type=movie", function(data) {
        collections = JSON.parse(data);
        console.log("Loaded " + collections.length + " collections");
      });
    }

    // Функция для добавления обработчиков событий для элементов интерфейса
    function add_event_listeners() {
      // Обработчик события клика по элементу нижнего меню
      function on_bottom_menu_item_click(event) {
        var id = event.target.id;
        switch (id) {
          case "all":
            show_all_screen();
            break;
          case "search":
            show_search_screen();
            break;
          case "favorite":
            show_favorite_screen();
            break;
          case "profile":
            show_profile_screen();
            break;
        }
        // Подсветка активного элемента нижнего меню
        var items = document.getElementsByClassName("bottom-menu-item");
        for (var i = 0; i < items.length; i++) {
          if (items[i].id == id) {
            items[i].classList.add("active");
          } else {
            items[i].classList.remove("active");
          }
        }
      }

      // Обработчик события клика по элементу карусели фильмов или сериалов
      function on_movie_card_click(event) {
        var id = event.target.id;
        show_detail_screen(id);
      }

      // Обработчик события клика по элементу заголовка карусели фильмов или сериалов
      function on_carousel_title_click(event) {
        var title = event.target.innerHTML;
        show_all_screen(title);
      }

      // Обработчик события клика по элементу вкладки фильмов или сериалов на экране со всеми фильмами и сериалами
      function on_all_screen_tab_click(event) {
        var id = event.target.id;
        switch (id) {
          case "movies-tab":
            show_all_movies();
            break;
          case "series-tab":
            show_all_series();
            break;
        }
        // Подсветка активной вкладки на экране со всеми фильмами и сериалами
        var tabs = document.getElementsByClassName("all-screen-tab");
        for (var i = 0; i < tabs.length; i++) {
          if (tabs[i].id == id) {
            tabs[i].classList.add("active");
          } else {
            tabs[i].classList.remove("active");
          }
        }
      }

      // Обработчик события клика по кнопке Смотреть на экране с деталями фильма или сериала
      function on_watch_button_click(event) {
        var id = event.target.id;
        show_player_screen(id);
      }

      // Обработчик события клика по кнопке Лайк на экране с деталями фильма или сериала
            function on_like_button_click(event) {
        var id = event.target.id;
        // Проверка, что пользователь авторизован
        if (is_logged_in()) {
          // Добавление фильма или сериала в избранное пользователя
          add_to_favorite(id);
          // Изменение цвета кнопки Лайк на зеленый
          event.target.style.color = "green";
          // Вывод сообщения об успешном добавлении в избранное
          alert("Вы добавили этот фильм или сериал в избранное!");
        } else {
          // Вывод сообщения о необходимости авторизации
          alert("Вы должны войти в свой профиль, чтобы лайкать фильмы или сериалы!");
        }
      }

      // Обработчик события клика по кнопке Дизлайк на экране с деталями фильма или сериала
      function on_dislike_button_click(event) {
        var id = event.target.id;
        // Проверка, что пользователь авторизован
        if (is_logged_in()) {
          // Удаление фильма или сериала из избранного пользователя
          remove_from_favorite(id);
          // Изменение цвета кнопки Дизлайк на красный
          event.target.style.color = "red";
          // Вывод сообщения об успешном удалении из избранного
          alert("Вы удалили этот фильм или сериал из избранного!");
        } else {
          // Вывод сообщения о необходимости авторизации
          alert("Вы должны войти в свой профиль, чтобы дизлайкать фильмы или сериалы!");
        }
      }

      // Обработчик события клика по кнопке Поделиться на экране с деталями фильма или сериала
      function on_share_button_click(event) {
        var id = event.target.id;
        // Получение ссылки на фильм или сериал из базы данных
        var link = get_movie_link(id);
        // Копирование ссылки в буфер обмена
        copy_to_clipboard(link);
        // Вывод сообщения о том, что ссылка скопирована
        alert("Вы скопировали ссылку на этот фильм или сериал!");
      }

      // Добавление обработчиков событий к элементам нижнего меню
      var bottom_menu_items = document.getElementsByClassName("bottom-menu-item");
      for (var i = 0; i < bottom_menu_items.length; i++) {
        bottom_menu_items[i].addEventListener("click", on_bottom_menu_item_click);
      }
    }

    // Функция для отображения главного экрана с каруселями фильмов и сериалов
    function show_main_screen() {
      // Очистка содержимого главного экрана
      var main_screen = document.getElementById("main-screen");
      main_screen.innerHTML = "";
      
      // Создание карусели популярных новинок фильмов
      var popular_movies_carousel = create_carousel("Популярные новинки фильмов", movies.slice(0, 10));
      
            // Создание карусели популярных сериалов
      var popular_series_carousel = create_carousel("Популярные сериалы", series.slice(0, 10));

      // Создание карусели недавно добавленных фильмов
      var recent_movies_carousel = create_carousel("Недавно добавленные фильмы", movies.slice(10, 20));

      // Создание карусели новых серий
      var new_episodes_carousel = create_carousel("Новые серии", series.slice(10, 20));

      // Добавление каруселей на главный экран
      main_screen.appendChild(popular_movies_carousel);
      main_screen.appendChild(popular_series_carousel);
      main_screen.appendChild(recent_movies_carousel);
      main_screen.appendChild(new_episodes_carousel);

      // Отображение главного экрана
      main_screen.style.display = "block";
    }

    // Функция для создания карусели фильмов или сериалов
    function create_carousel(title, movies) {
      // Создание элемента карусели
      var carousel = document.createElement("div");
      carousel.className = "carousel";

      // Создание элемента заголовка карусели
      var carousel_title = document.createElement("div");
      carousel_title.className = "carousel-title";
      carousel_title.innerHTML = title;
      carousel_title.addEventListener("click", on_carousel_title_click);

      // Создание элемента содержимого карусели
      var carousel_content = document.createElement("div");
      carousel_content.className = "carousel-content";

      // Добавление элементов карточек фильмов или сериалов в содержимое карусели
      for (var i = 0; i < movies.length; i++) {
        var movie_card = document.createElement("div");
        movie_card.className = "movie-card";
        movie_card.id = movies[i].id;
        movie_card.style.backgroundImage = "url('" + movies[i].poster + "')";
        movie_card.addEventListener("click", on_movie_card_click);
        carousel_content.appendChild(movie_card);
      }

      // Добавление элементов заголовка и содержимого в элемент карусели
            // Добавление элементов заголовка и содержимого в элемент карусели
      carousel.appendChild(carousel_title);
      carousel.appendChild(carousel_content);

      // Возвращение элемента карусели
      return carousel;
    }
    
        // Функция для отображения экрана со всеми фильмами и сериалами
    function show_all_screen(title) {
      // Очистка содержимого экрана со всеми фильмами и сериалами
      var all_screen = document.getElementById("all-screen");
      all_screen.innerHTML = "";

      // Создание элементов вкладок фильмов и сериалов
      var movies_tab = document.createElement("div");
      movies_tab.className = "all-screen-tab";
      movies_tab.id = "movies-tab";
      movies_tab.innerHTML = "Фильмы";
      movies_tab.addEventListener("click", on_all_screen_tab_click);

      var series_tab = document.createElement("div");
      series_tab.className = "all-screen-tab";
      series_tab.id = "series-tab";
      series_tab.innerHTML = "Сериалы";
      series_tab.addEventListener("click", on_all_screen_tab_click);

      // Создание элемента содержимого экрана со всеми фильмами и сериалами
      var all_screen_content = document.createElement("div");
      all_screen_content.className = "all-screen-content";
      all_screen_content.id = "all-screen-content";

      // Добавление элементов вкладок и содержимого на экран со всеми фильмами и сериалами
      all_screen.appendChild(movies_tab);
      all_screen.appendChild(series_tab);
      all_screen.appendChild(all_screen_content);

      // Скрытие других экранов
      hide_other_screens(all_screen);

      // Проверка, есть ли параметр title, указывающий на то, какую карусель выбрал пользователь
      if (title) {
        // Определение типа фильмов или сериалов по заголовку карусели
        var type = get_type_by_title(title);
        // Подсветка соответствующей вкладки на экране со всеми фильмами и сериалами
        if (type == "movie") {
          movies_tab.classList.add("active");
          series_tab.classList.remove("active");
        } else {
          series_tab.classList.add("active");
          movies_tab.classList.remove("active");
        }
        // Отображение соответствующих фильмов или сериалов на экране со всеми фильмами и сериалами
        show_all_movies_by_type(type);
      } else {
        // По умолчанию отображение всех фильмов на экране со всеми фильмами и сериалами
        movies_tab.classList.add("active");
        series_tab.classList.remove("active");
        show_all_movies();
      }
    }

    // Функция для определения типа фильмов или сериалов по заголовку карусели
    function get_type_by_title(title) {
      switch (title) {
        case "Популярные новинки фильмов":
        case "Недавно добавленные фильмы":
          return "movie";
        case "Популярные сериалы":
        case "Новые серии":
          return "series";
        default:
          return null;
      }
    }

        // Функция для отображения всех фильмов на экране со всеми фильмами и сериалами
    function show_all_movies() {
      // Очистка содержимого экрана со всеми фильмами и сериалами
      var all_screen_content = document.getElementById("all-screen-content");
      all_screen_content.innerHTML = "";

      // Добавление элементов карточек фильмов в содержимое экрана со всеми фильмами и сериалами
      for (var i = 0; i < movies.length; i++) {
        var movie_card = document.createElement("div");
        movie_card.className = "movie-card";
        movie_card.id = movies[i].id;
        movie_card.style.backgroundImage = "url('" + movies[i].poster + "')";
        movie_card.addEventListener("click", on_movie_card_click);
        all_screen_content.appendChild(movie_card);
      }
    }

    // Функция для отображения всех сериалов на экране со всеми фильмами и сериалами
    function show_all_series() {
      // Очистка содержимого экрана со всеми фильмами и сериалами
      var all_screen_content = document.getElementById("all-screen-content");
      all_screen_content.innerHTML = "";

      // Добавление элементов карточек сериалов в содержимое экрана со всеми фильмами и сериалами
      for (var i = 0; i < series.length; i++) {
        var series_card = document.createElement("div");
        series_card.className = "movie-card";
        series_card.id = series[i].id;
        series_card.style.backgroundImage = "url('" + series[i].poster + "')";
        series_card.addEventListener("click", on_movie_card_click);
        all_screen_content.appendChild(series_card);
      }
    }

    // Функция для отображения всех фильмов или сериалов определенного типа на экране со всеми фильмами и сериалами
    function show_all_movies_by_type(type) {
      // Определение массива фильмов или сериалов по типу
      var movies_by_type = [];
      if (type == "movie") {
        movies_by_type = movies;
      } else {
        movies_by_type = series;
      }

            // Очистка содержимого экрана со всеми фильмами и сериалами
      var all_screen_content = document.getElementById("all-screen-content");
      all_screen_content.innerHTML = "";

      // Добавление элементов карточек фильмов или сериалов в содержимое экрана со всеми фильмами и сериалами
      for (var i = 0; i < movies_by_type.length; i++) {
        var movie_card = document.createElement("div");
        movie_card.className = "movie-card";
        movie_card.id = movies_by_type[i].id;
        movie_card.style.backgroundImage = "url('" + movies_by_type[i].poster + "')";
        movie_card.addEventListener("click", on_movie_card_click);
        all_screen_content.appendChild(movie_card);
      }
    }

    // Функция для отображения экрана с деталями фильма или сериала
    function show_detail_screen(id) {
      // Получение данных о фильме или сериале по id из базы данных
      ajax("https://qna.su/movies.php?action=get_movie_by_id&id=" + id, function(data) {
        var movie = JSON.parse(data);

        // Заполнение элементов экрана с деталями фильма или сериала данными о фильме или сериале
        var detail_screen_poster = document.getElementById("detail-screen-poster");
        detail_screen_poster.style.backgroundImage = "url('" + movie.poster + "')";

        var detail_screen_title = document.getElementById("detail-screen-title");
        detail_screen_title.innerHTML = movie.title;

        var detail_screen_rating = document.getElementById("detail-screen-rating");
        detail_screen_rating.innerHTML = "Рейтинг: " + movie.rating;

        var watch_button = document.getElementById("watch");
        watch_button.id = movie.id;
        watch_button.addEventListener("click", on_watch_button_click);

                var like_button = document.getElementById("like");
        like_button.id = movie.id;
        like_button.addEventListener("click", on_like_button_click);

        var dislike_button = document.getElementById("dislike");
        dislike_button.id = movie.id;
        dislike_button.addEventListener("click", on_dislike_button_click);

        var share_button = document.getElementById("share");
        share_button.id = movie.id;
        share_button.addEventListener("click", on_share_button_click);

        var date = document.getElementById("date");
        date.innerHTML = "Дата: " + movie.date;

        var director = document.getElementById("director");
        director.innerHTML = "Режиссёр: " + movie.director;

        var tags = document.getElementById("tags");
        tags.innerHTML = "";
        for (var i = 0; i < movie.tags.length; i++) {
          var tag = document.createElement("div");
          tag.className = "tag";
          tag.innerHTML = movie.tags[i];
          tags.appendChild(tag);
        }

        var cast = document.getElementById("cast");
        cast.innerHTML = "";
        for (var i = 0; i < movie.cast.length; i++) {
          var actor_card = document.createElement("div");
          actor_card.className = "actor-card";
          actor_card.style.backgroundImage = "url('" + movie.cast[i].photo + "')";
          actor_card.innerHTML = "<p>" + movie.cast[i].name + "</p><p>" + movie.cast[i].role + "</p>";
          cast.appendChild(actor_card);
        }

        var description = document.getElementById("description");
        description.innerHTML = movie.description;

        // Скрытие других экранов
        hide_other_screens(detail_screen);

        // Отображение экрана с деталями фильма или сериала
        detail_screen.style.display = "block";
      });
    }
    
        // Функция для отображения экрана с плеером для просмотра фильма или сериала
    function show_player_screen(id) {
      // Получение данных о фильме или сериале по id из базы данных
      ajax("https://qna.su/movies.php?action=get_movie_by_id&id=" + id, function(data) {
        var movie = JSON.parse(data);

        // Заполнение элемента плеера данными о фильме или сериале
        var player_frame = document.getElementById("player-frame");
        player_frame.src = movie.playframe;

        // Скрытие других экранов
        hide_other_screens(player_frame);

        // Отображение экрана с плеером
        player_frame.style.display = "block";
      });
    }

    // Функция для скрытия всех экранов, кроме указанного
    function hide_other_screens(screen) {
      var screens = document.getElementsByClassName("screen");
      for (var i = 0; i < screens.length; i++) {
        if (screens[i] != screen) {
          screens[i].style.display = "none";
        }
      }
    }

    // Функция для отправки асинхронного запроса к серверу
    function ajax(url, callback) {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          callback(xhr.responseText);
        }
      };
      xhr.send();
    }

    // Запуск приложения
    OnStart();
    </script>
</body>
</html>
