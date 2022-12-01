export const hamburger = (button: Element | null, menu: Element | null, html: Element | null) => {
  button?.addEventListener('click', () => {
    html?.classList.toggle('gnav-open');
    button!.classList.toggle('js-active');
    menu!.classList.toggle('js-active');
  });

  // ### ページ内リンクでハンバーガーが閉じるように
  // ----------------------------------------------------------------------
  const pageLink = document.querySelectorAll('a[href^="#"]');
  for (let i = 0; i < pageLink.length; i++) {
    pageLink[i].addEventListener('click', () => {
      button!.classList.remove('js-active');
      menu!.classList.remove('js-active');
    });
    window.scrollBy(0, -100);
  }
};
