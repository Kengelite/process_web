  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <!-- <li class="nav-item">

              <i class="bi bi-grid"></i>
              <span>Menu</span>
              </a>
          </li>End Dashboard Nav -->

          <li class="nav-heading ">Pages</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pageprofile') }}">
                  <i class="bi bi-person"></i>
                  <span>ข้อมูลส่วนตัว</span>
              </a>
          </li><!-- End Profile Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pageform') }}">
                  <i class="bi bi-question-circle"></i>
                  <span>แบบสอบถาม</span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{route('pagecontact')}}">
                  <i class="bi bi-envelope"></i>
                  <span>ติดต่อสอบถาม</span>
              </a>
          </li>

          <!-- <li class="nav-item">
              <a class="nav-link collapsed" href="pages-register.html">
                  <i class="bi bi-card-list"></i>
                  <span>สมัครสมาชิก</span>
              </a>
          </li> -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('pagelogin') }}">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>เข้าสู่ระบบ</span>
              </a>
          </li><!-- End Login Page Nav -->

          

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