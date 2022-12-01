export const commonScroll = (html: Element | null) => {
  let set_position = 0;

  window.addEventListener('scroll', function () {
    if (set_position < document.documentElement.scrollTop) {
      html!.classList.add('scroll-down');
      html!.classList.remove('scroll-up');
    } else {
      html!.classList.remove('scroll-down');
      html!.classList.add('scroll-up');
    }
    set_position = document.documentElement.scrollTop;

    // ### サイトの一番下の時
    // ----------------------------------------------------------------------
    const clientHeight = html!.clientHeight;
    const scrollHeight = html!.scrollHeight;
    if (scrollHeight - (clientHeight + document.documentElement.scrollTop) == 0) {
      html!.classList.add('scroll-end');
    } else {
      html!.classList.remove('scroll-end');
    }
  });
};
