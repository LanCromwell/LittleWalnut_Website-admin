import request from '@/utils/request';

export function fetchList(query) {
  return request({
    url: '/admin/language',
    method: 'get',
    params: query,
  });
}

export function updateData(data) {
  return request({
    url: '/admin/category/store',
    method: 'post',
    data,
  });
}

export function fetchCategory(id) {
  return request({
    url: '/admin/category/' + id,
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

export function updateArticle(data) {
  return request({
    url: '/article/update',
    method: 'post',
    data,
  });
}
