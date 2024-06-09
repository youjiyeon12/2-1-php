// HTML 문서의 DOMContentLoaded 이벤트가 발생하면 실행되는 함수
document.addEventListener("DOMContentLoaded", function() {
    // 클래스 이름이 'slide'인 모든 요소를 선택하여 slides 변수에 할당
    const slides = document.querySelectorAll('.slide');
    // 현재 슬라이드의 인덱스를 나타내는 변수를 초기화
    let currentSlideIndex = 0;

    // 주어진 인덱스에 해당하는 슬라이드를 화면에 보여주는 함수
    function showSlide(index) {
        slides.forEach((slide, idx) => {
            // 슬라이드의 위치를 조정하여 화면에 표시
            slide.style.transform = `translateX(${100 * (idx - index)}%)`;
        });
    }

    // 다음 슬라이드를 보여주는 함수
    function nextSlide() {
        // 현재 슬라이드의 인덱스를 증가시키고, 슬라이드의 개수로 나눈 나머지를 새로운 인덱스로 설정하여 순환
        currentSlideIndex = (currentSlideIndex + 1) % slides.length;
        // 변경된 인덱스에 해당하는 슬라이드를 보여줌
        showSlide(currentSlideIndex);
    }

    // 4초마다 다음 슬라이드를 보여주는 타이머를 설정
    setInterval(nextSlide, 4000);
});
