import React, { useEffect } from 'react';

const styles = {

}

function Test(props) {

  // useFef()
  const reContainer = useRef(null);
  const onButtonClick = () => {
    // 'current'는 마운트된 input element를 가리킴
    inputElem.current.focus();
  }
  // useEffect(이펙트 함수, 의존성 배열)
  // 컴포넌트가 리렌더링 될 때마다 실행됨
  // 의존성 배열에 있는 변수들 중 하나라도 값이 변경되었을 때 실행됨
  // 의존성 배열에 빈 배열([])을 넣으면 마운트와 언마운트 시에 단 한 번 씩만 실행됨
  // 의존성 배열 생략 시 컴포넌트 업데이트 시마다 실행
  useEffect(() => {
    document.title = 'You clicked ${} times'
  })


  // 연상량이 높은 작업을 수행하여 결과를 반환
  // 의존성 배열을 넣지 않을 경우, 매 렌더링마다 함수가 실행됨
  // const memoizedValue = useMemo(
  //   ()=> {
  //     return computeExpensiveValue( 의존성 변수1, 의존성 변수2 );
  //   },
  //   [의존성 변수1, 의존성 변수2]
  // )
  const [Test , setTest] =useState(0);

    return (
      // 컴포넌트가 마운트 해제되기 전에 실행
		<div>
        <div>로그인</div>
        <div>{Test}</div>
        <button onClick={ () => setTest(Test + 1)}></button>
		</div>
    );
}

// eslint-plugin-react-hooks
// 훅을 강제로 따르게 해주는거

export default Test;