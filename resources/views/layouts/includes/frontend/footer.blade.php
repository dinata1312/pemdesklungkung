<footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>{{ app_name()[0] }} <span>{{ value_of_key(app_name(),1) }}</span></h3>
            <p>
              {{ collection_match($settings, 'key', 'address', 'value') }}
              <strong><br>Telepon:</strong> {{ collection_match($settings, 'key', 'phone', 'value') }}<br>
              <strong>Surel:</strong> {{ collection_match($settings, 'key', 'email', 'value') }}<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>{{ collection_match($sections, 'key', 'footer-1', 'title') }}</h4>
            <ul>{!! collection_match($sections, 'key', 'footer-1', 'content') !!}</ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>{{ collection_match($sections, 'key', 'footer-2', 'title') }}</h4>
            <ul>{!! collection_match($sections, 'key', 'footer-2', 'content') !!}</ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container py-4 d-md-flex">

      <div class="text-center me-md-auto text-md-start">
        <div class="copyright">
          &copy; Hak cipta dari <strong>{{ app_name()[0] }} <span>{{ value_of_key(app_name(),1) }}</span></strong>.
        </div>
        <div class="credits">
          Dirancang oleh <a href="{{ Config::get('settings.dev_url') }}">{{  Config::get('settings.dev_org') }}</a>
        </div>
      </div>
      <div class="pt-3 text-center social-links text-md-end pt-md-0">
        @if (!empty($url = collection_match($settings, 'key', 'twitter', 'value')))
        <a href="{{ $url }}" class="twitter"><i class="bx bxl-twitter"></i></a>
        @endif
        @if (!empty($url = collection_match($settings, 'key', 'facebook', 'value')))
        <a href="{{ $url }}" class="facebook"><i class="bx bxl-facebook"></i></a>
        @endif
        @if (!empty($url = collection_match($settings, 'key', 'instagram', 'value')))
        <a href="{{ $url }}" class="instagram"><i class="bx bxl-instagram"></i></a>
        @endif
        @if (!empty($url = collection_match($settings, 'key', 'linkedin', 'value')))
        <a href="{{ $url }}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        @endif
      </div>
    </div>
  </footer>
