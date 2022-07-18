import request from '@/utils/request';

export function fetchList(query) {
  return request({
    url: '/admin/channel',
    method: 'get',
    params: query,
  });
}

export function getChannel(id) {
  return request({
    url: '/admin/channel/' + id,
    method: 'get',
  });
}

export function storeChannel(data) {
  return request({
    url: '/admin/channel/store',
    method: 'post',
    data,
  });
}

export function updateArticle(data) {
  return request({
    url: '/article/update',
    method: 'post',
    data,
  });
}
