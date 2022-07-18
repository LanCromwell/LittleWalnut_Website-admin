import request from '@/utils/request';

export function insertData(data) {
  return request({
    url: '/admin/date-poster/store',
    method: 'post',
    data,
  });
}
export function getAudioInfo(id) {
  return request({
    url: '/admin/date-poster/' + id,
    method: 'get',
  });
}
export function fetchList(query) {
  return request({
    url: '/admin/date-poster',
    method: 'get',
    params: query,
  });
}
