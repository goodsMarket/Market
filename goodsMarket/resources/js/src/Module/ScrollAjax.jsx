/**
 * 만들진 않았는데 일단 백업
 */
export const listForm = {
    call_package: {
        used_trades: {
            12: [
                'recent_view',
                'recommand',
            ],
        },
        productions: {
            12: [
                'recent_view',
                'recent',
            ],
        },
    }
}

export function scroll_ajax() {
    // 스크롤 발생을 위한 감시
    const points = document.querySelectorAll('.ajaxPoint')
    const lastPoint = points[points.length - 1]
    const [targetElement, setTargetElement] = useState(lastPoint);

    // 대상 관찰 시 ajax 요청
    function handleElementVisibility() {
        axios.patch('/list', listForm)
            .then(res => {
                if ('message' in res.data) {
                    return res.data.message;
                } else {
                    console.log(res.data);
                }
            })
            .then(res => {
                setusedList(res.used_trades);
                setprodList(res.productions);
            })
            .catch(err => {
                console.log(err.stack);
            })
    }

    // 리스트 받아오기
    const [usedList, setusedList] = useState(null);
    const [prodList, setprodList] = useState(null);

    useEffect(() => {
        if (!targetElement) return; // 초기에는 관찰하지 않음

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    handleElementVisibility();
                }
            });
        });

        observer.observe(targetElement);

        return () => {
            observer.unobserve(targetElement);
        };
    }, [/* 탭 누를때마다 가져오기 vs 가져오는건 F5해라 */]);
}