export const scrollAddClass = function (targetElement: NodeListOf<Element>) {
  window.addEventListener('scroll', () => {
    //Classを追加する要素を取得
    // const target = document.querySelectorAll('.js-scroll');
    //Classを追加する位置を指定（ビューポート内）
    const position = Math.floor(window.innerHeight * 0.9); //左記はビューポート内の上から90%の位置を指定

    //要素の数だけループする
    for (let i = 0; i < targetElement.length; i++) {
      //要素の上部座標を取得する（小数点切り捨て）
      const offsetTop = Math.floor(targetElement[i].getBoundingClientRect().top);

      //要素の上部座標がpositionの位置を通過したら
      if (offsetTop < position) {
        //要素にClassを追加する
        targetElement[i].classList.add('js-active');
      }
    }
  });
};
