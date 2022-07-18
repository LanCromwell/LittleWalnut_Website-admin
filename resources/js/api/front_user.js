import request from '@/utils/request';

export function fetchList(query) {
  return request({
    url: '/admin/front_users',
    method: 'get',
    params: query,
  });
}

export function updateFrontUser(data) {
  return request({
    url: '/admin/front_users/update',
    method: 'post',
    data,
  });
}

export function updateFrontUserPwd(data) {
  return request({
    url: '/admin/front_users/update_pwd',
    method: 'post',
    data,
  });
}

export function getFrontUser(id) {
  return request({
    url: '/admin/front_users/' + id,
    method: 'get',
  });
}

export function fetchPv(id) {
  return request({
    url: '/articles/' + id + '/pageviews',
    method: 'get',
  });
}

export function createArticle(data) {
  return request({
    url: '/article/create',
    method: 'post',
    data,
  });
}
