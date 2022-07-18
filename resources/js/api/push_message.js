import request from '@/utils/request';

export function fetchList(query) {
  return request({
    url: '/admin/push_message',
    method: 'get',
    params: query,
  });
}

export function createArticle(data) {
  return request({
    url: '/article/create',
    method: 'post',
    data,
  });
}

export function updatePushMsg(data) {
  return request({
    url: '/admin/push_message/edit',
    method: 'post',
    data,
  });
}
