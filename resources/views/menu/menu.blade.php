  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">
          <li class="nav-heading ">ทรัพย์สินองค์กร ( CP Assets )</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('pageindex')}}">
                  <i class="bi bi-person"></i>
                  <span>หน้าแรก</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-faq.html">
                  <i class="bi bi-question-circle"></i>
                  <span>กระบวนการ ( Process ) </span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-contact.html">
                  <i class="bi bi-envelope"></i>
                  <span>โปรเจค ( Project )</span>
              </a>
          </li><!-- End Contact Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-register.html">
                  <i class="bi bi-card-list"></i>
                  <span>ผลิตภัณฑ์ ( Product )</span>
              </a>
          </li><!-- End Register Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-login.html">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span> เจ้าหน้าที่ 
                  <!-- Login -->
                  </span>
              </a>
          </li><!-- End Login Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-error-404.html">
                  <i class="bi bi-dash-circle"></i>
                  <span>อาจารย์</span>
              </a>
          </li><!-- End Error 404 Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-blank.html">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>ออกจากระบบ</span>
              </a>
          </li><!-- End Blank Page Nav -->

      </ul>

  </aside><!-- End Sidebar-->

  <script>
document.addEventListener('DOMContentLoaded', function() {
    const pathSegments = window.location.pathname.split('/'); // Split the path by "/"

    // Check the third segment of the path (index starts from 0)
    if (pathSegments[1] === 'person') {
        var element_p3 = document.getElementById('index');
        element_p3.classList.add('remove');
        var element_p1 = document.getElementById('person');
        element_p1.classList.add('active');
        console.log('asdaddsa')
        if (pathSegments[2] === 'personnel') {
            var element_p2 = document.getElementById('personnel');
            element_p2.classList.add('active');
        } else if (pathSegments[2] === 'student') {
            var element_p2 = document.getElementById('student');
            element_p2.classList.add('active');
        }
    }
    if (pathSegments[1] === 'journalall') {
        var element_p3 = document.getElementById('index');
        element_p3.classList.add('remove');
        var element_p1 = document.getElementById('journalall');
        element_p1.classList.add('active');
        console.log('asdaddsa')
        if (pathSegments[2] === 'journal') {
            var element_p2 = document.getElementById('journal');
            element_p2.classList.add('active');
        } else if (pathSegments[2] === 'conference') {
            var element_p2 = document.getElementById('conference');
            element_p2.classList.add('active');
        }
    }
    if (pathSegments[1] === 'compare') {
        var element_p3 = document.getElementById('index');
        element_p3.classList.add('remove');
        var element_p1 = document.getElementById('compare');
        element_p1.classList.add('active');
        console.log('asdaddsa')
        if (pathSegments[2] === 'university') {
            var element_p2 = document.getElementById('university');
            element_p2.classList.add('active');
        } else if (pathSegments[2] === 'conference') {
            var element_p2 = document.getElementById('conference');
            element_p2.classList.add('active');
        }
    }

});
  </script>