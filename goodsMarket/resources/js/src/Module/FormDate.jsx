export default function formatDate(dateString) {
    const now = new Date();
    const date = new Date(dateString);
    const diff = Math.floor((now - date) / 1000); // in seconds
  
    // 함수 내에서 사용할 유틸리티 함수들
    function pluralize(count, noun) {
      return count === 1 ? noun : noun + 's';
    }
  
    function formatTimeAgo(seconds, timeUnit) {
      const time = Math.round(seconds / timeUnit);
      return `${time} ${pluralize(time, timeUnit)} 전`;
    }
  
    // 현재 시간과의 차이 계산
    if (diff < 60) {
      return '방금';
    } else if (diff < 3600) {
      return formatTimeAgo(diff, 60); // minutes
    } else if (diff < 86400) {
      return formatTimeAgo(diff, 3600); // hours
    } else if (diff < 518400) { // 6 days
      const days = Math.floor(diff / 86400);
      return `${days} ${days, '일'} 전`;
    } else if (diff < 604800) { // 7 days
      return '일주일 전';
    } else {
      if (now.getFullYear() !== date.getFullYear()) {
        return `${date.getFullYear()}년 ${date.getMonth() + 1}월 ${date.getDate()}일`;
      } else {
        return `${date.getMonth() + 1}월 ${date.getDate()}일`;
      }
    }
  }