  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">

              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->
          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#-nav" data-bs-toggle="collapse" id="journalall">
                  <i class="bi bi-journal-text"></i><span>Journal All</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="" id="journal">
                          <i class="bi bi-circle"></i><span>Journal</span>
                      </a>
                      <!-- <i class="bi bi-circle"></i><span>Journal</span> -->
                      </a>
                  </li>
                  <li>

                      <!-- <i class="bi bi-circle"></i><span>Conference</span> -->
                      </a>
                  </li>
              </ul>
          </li>


          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" id="person">
                  <i class="bi bi-person-vcard"></i><span>รายละเอียด</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="" id="journal">
                          <i class="bi bi-circle"></i><span>บุคคลากร</span>
                      </a>
                      <!-- <i class="bi bi-circle"></i><span>บุคคลากร</span> -->
                      </a>
                  </li>
                  <li>

                  <a href="" id="journal">
                          <i class="bi bi-circle"></i><span>นักศึกษา</span>
                      </a>
                      </a>
                  </li>
              </ul>
          </li><!-- End Forms Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" id="compare">
                  <i class="bi bi-layout-text-window-reverse"></i><span>ตารางเปรียบเทียบ</span><i
                      class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>

                      <i class="bi bi-circle"></i><span>มหาลัย</span>
                      </a>
                  </li>
                  <li>
                      <!-- <a href="tables-general.html"> -->
                      <i class="bi bi-circle"></i><span>คณะ</span>
                      </a>
                  </li>
                  <li>
                      <!-- <a href="tables-data.html"> -->
                      <i class="bi bi-circle"></i><span>อาจารย์</span>
                      </a>
                  </li>
                  <li>
                      <!-- <a href="tables-data.html"> -->
                      <i class="bi bi-circle"></i><span>นักศึกษา</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Tables Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                  <li>
                      <!-- <a href="charts-chartjs.html"> -->
                      <i class="bi bi-circle"></i><span>Chart.js</span>
                      </a>
                  </li>
                  <li>
                      <!-- <a href="charts-apexcharts.html"> -->
                      <i class="bi bi-circle"></i><span>ApexCharts</span>
                      </a>
                  </li>
                  <li>
                      <!-- <a href="charts-echarts.html"> -->
                      <i class="bi bi-circle"></i><span>ECharts</span>
                      </a>
                  </li>
              </ul>
          </li><!-- End Charts Nav -->


          <li class="nav-heading mt-5">Pages</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="users-profile.html">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
              </a>
          </li><!-- End Profile Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-faq.html">
                  <i class="bi bi-question-circle"></i>
                  <span>F.A.Q</span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-contact.html">
                  <i class="bi bi-envelope"></i>
                  <span>Contact</span>
              </a>
          </li><!-- End Contact Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-register.html">
                  <i class="bi bi-card-list"></i>
                  <span>Register</span>
              </a>
          </li><!-- End Register Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-login.html">
                  <i class="bi bi-box-arrow-in-right"></i>
                  <span>Login</span>
              </a>
          </li><!-- End Login Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-error-404.html">
                  <i class="bi bi-dash-circle"></i>
                  <span>Error 404</span>
              </a>
          </li><!-- End Error 404 Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-blank.html">
                  <i class="bi bi-file-earmark"></i>
                  <span>Blank</span>
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