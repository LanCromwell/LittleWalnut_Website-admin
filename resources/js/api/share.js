import request from '@/utils/request';

export function getData(query) {
  return request({
    url: '/admin/share',
    method: 'get',
    params: query,
  });
}

export function updateData(data) {
  return request({
    url: '/admin/share/edit',
    method: 'post',
    data,
  });
}
